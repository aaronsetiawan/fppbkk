<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RekapitulasiTraining;
use App\Training;
use App\Pegawai;
use App\Anggaran;
use DB;
use Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $rekapalert = RekapitulasiTraining::leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->select('tanggal_training.tanggal_training as t', 'training.nama_training')
                        ->where('tanggal_training.tanggal_training', '>', DB::raw('CURDATE()'))
                        ->where('rekapitulasi_training.status_training', '!=', 'Terlaksana')
                        ->orderBy('tanggal_training.tanggal_training', 'ASC')
                        ->take(4)
                        ->distinct()
                        ->get();

        $rekapbiaya = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->select(DB::raw('SUM(rekapitulasi_training.biaya_lain) as biaya_lain'), DB::raw('SUM(rekapitulasi_training.harga_training) as harga_training'), DB::raw('SUM(rekapitulasi_training.invoice_training) as invoice_training'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();
                        
        $rekapbiayainhouse = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->leftJoin('media', 'training.id_media', '=', 'media.id_media')
                        ->select('media.kategori_media', DB::raw('SUM(rekapitulasi_training.invoice_training) as invoice_training_inhouse'))
                        ->where('media.kategori_media', '=', 'Inhouse') 
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $rekapbiayapublik = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->leftJoin('media', 'training.id_media', '=', 'media.id_media')
                        ->select('media.kategori_media', DB::raw('SUM(rekapitulasi_training.invoice_training) as invoice_training_publik'))
                        ->where('media.kategori_media', '=', 'Publik')
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $total_harga = $rekapbiaya[0]->harga_training;
        $total_invoice = $rekapbiaya[0]->invoice_training;
        $total_invoice_inhouse = $rekapbiayainhouse[0]->invoice_training_inhouse;
        $total_invoice_publik = $rekapbiayapublik[0]->invoice_training_publik;
        $total_biaya_lain = $rekapbiaya[0]->biaya_lain;
        $selisih = $total_harga - $total_invoice;
        $total_terpakai = $total_invoice + $total_biaya_lain;

        $anggaran = DB::table('anggaran')
                        ->select('anggaran.jumlah_anggaran')
                        ->where('anggaran.tahun_anggaran', '=', DB::raw('YEAR(CURDATE())'))
                        ->get();

        $anggaran2 = $anggaran[0]->jumlah_anggaran;
        $real_sisa_dana = $anggaran2 - $total_invoice - $total_biaya_lain;
        $utilisasi = round($total_terpakai / $anggaran2 * 100,2);

        $toptrainee = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->select('pegawai.nama_pegawai', DB::raw('COUNT(rekapitulasi_training.id_rekapitulasi_training) as total_training'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->groupBy('nama_pegawai')
                        ->orderBy('total_training', 'dsc')
                        ->take(5)
                        ->get();

        $sum = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->select(DB::raw('SUM(rekapitulasi_training.jumlah_jam_training) as sum'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();
        $total = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->select(DB::raw('COUNT(rekapitulasi_training.id_rekapitulasi_training) as total_training'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $jamperpegawai = round($sum[0]->sum/$total[0]->total_training,2);

        $hariperpegawai = round($sum[0]->sum/$total[0]->total_training / 8,2);

        $totalpegawai1 = DB::table('pegawai')
                        ->select(DB::raw('COUNT(pegawai.nik_pegawai) as totalpegawai'))
                        ->get();

        $totalpegawai = $totalpegawai1[0]->totalpegawai; 

        $totalgiat1 = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->leftJoin('media', 'training.id_media', '=', 'media.id_media')
                        ->select('media.nama_media', DB::raw('COUNT(DISTINCT rekapitulasi_training.nik_pegawai) as giat'))
                        ->where('media.nama_media', '=', 'Giat')
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $totaljuara1 = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->leftJoin('media', 'training.id_media', '=', 'media.id_media')
                        ->select('media.nama_media', DB::raw('COUNT(DISTINCT rekapitulasi_training.nik_pegawai) as juara'))
                        ->where('media.nama_media', '=', 'Juara')
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $pegawaitraining1 = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->leftJoin('media', 'training.id_media', '=', 'media.id_media')
                        ->select(DB::raw('COUNT(DISTINCT rekapitulasi_training.nik_pegawai) as pegawaitraining'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $pesertatraining1 = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_rekapitulasi', 'tanggal_rekapitulasi.id_rekapitulasi_training', '=', 'rekapitulasi_training.id_rekapitulasi_training')
                        ->leftJoin('tanggal_training', 'tanggal_training.id_tanggal_training', '=', 'tanggal_rekapitulasi.id_tanggal_training')
                        ->leftJoin('media', 'training.id_media', '=', 'media.id_media')
                        ->select(DB::raw('COUNT(rekapitulasi_training.id_rekapitulasi_training) as pesertatraining'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->get();

        $totalgiat = $totalgiat1[0]->giat;
        $totaljuara = $totaljuara1[0]->juara;
        $pegawaitraining = $pegawaitraining1[0]->pegawaitraining;
        $pesertatraining = $pesertatraining1[0]->pesertatraining;
        // dd($pesertatraining);

        $jumlahjam = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('topik', 'training.id_topik', '=', 'topik.id_topik')
                        ->select('topik.nama_topik as topik',  DB::raw('SUM(rekapitulasi_training.jumlah_jam_training) as jumlahjam'))
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->groupBy('topik') 
                        ->get()->toArray();
                        
        $jumlahpeserta = RekapitulasiTraining::leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')
                        ->leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')
                        ->leftJoin('topik', 'training.id_topik', '=', 'topik.id_topik')
                        ->select('topik.nama_topik as topik', DB::raw('COUNT(rekapitulasi_training.id_rekapitulasi_training) as jumlahpeserta')) 
                        ->where('rekapitulasi_training.status_training', '=', 'Terlaksana') 
                        ->groupBy('topik')
                        ->get();

        $jumlahkegiatan = DB::select(DB::raw("select x.topik, SUM(x.jumlahkegiatan) as jumlahkegiatan1 FROM (select DISTINCT count(rekapitulasi_training.id_training) as jumlahkegiatan, periode, topik.nama_topik as topik from rekapitulasi_training, training, topik where training.id_training = rekapitulasi_training.id_training AND training.id_topik = topik.id_topik AND rekapitulasi_training.status_training = 'Terlaksana' group by periode, training.id_topik) x GROUP BY x.topik"));

        return view('index', ['anggaran' => $anggaran], compact('total_harga', 'total_invoice', 'total_biaya_lain', 'anggaran', 'toptrainee', 'jamperpegawai', 'hariperpegawai', 'selisih', 'total_terpakai', 'real_sisa_dana', 'utilisasi', 'total_invoice_publik', 'total_invoice_inhouse', 'totalgiat', 'totaljuara', 'totalpegawai', 'pegawaitraining', 'jumlahjam', 'jumlahpeserta', 'jumlahkegiatan', 'rekapalert', 'pesertatraining'));
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
