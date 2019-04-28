<?php

namespace App\Http\Controllers;

use App\RekapitulasiTraining;
use App\RekapPeserta;
use App\TanggalTraining;
use App\TanggalRekapitulasi;
use App\Training;
use App\Pegawai;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekapitulasiTrainingController extends Controller
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
        $all = RekapitulasiTraining::leftJoin('training','rekapitulasi_training.id_training','=','training.id_training')->leftJoin('pegawai', 'rekapitulasi_training.nik_pegawai', '=', 'pegawai.nik_pegawai')->leftJoin('departemen', 'pegawai.id_departemen','=','departemen.id_departemen')->leftJoin('divisi','departemen.id_divisi','=','divisi.id_divisi')->leftJoin('media','media.id_media','=','training.id_media')->leftJoin('topik','topik.id_topik','=','training.id_topik')->leftJoin('penyelenggara','penyelenggara.id_penyelenggara','=','training.id_penyelenggara')->leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')->leftJoin('maxmin_tanggal_training','rekapitulasi_training.id_rekapitulasi_training','=','maxmin_tanggal_training.id_rekapitulasi_training')->select('rekapitulasi_training.*','training.nama_training','rekapitulasi_training.harga_training','rekapitulasi_training.invoice_training','pegawai.nama_pegawai','divisi.nama_divisi','media.nama_media','topik.nama_topik','penyelenggara.nama_penyelenggara','kompetensi.nama_kompetensi','maxmin_tanggal_training.tgl_min','maxmin_tanggal_training.tgl_max')->orderBy('id_rekapitulasi_training','DESC')->get();
        // dd($all);
        return view('rekapitulasiTraining.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        $training = Training::all();
        return view('rekapitulasiTraining.tambah',compact('pegawai','training'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_training' => 'required',
            'nik_pegawai' => 'required',
            'justifikasi' => 'required',
            'jumlah_jam_training' => 'required',
            'harga_training' => 'required|numeric'
        ]);
        // dd($request->nik_pegawai);
        foreach($request->nik_pegawai as $nik) {
            $lastRow = RekapitulasiTraining::orderBy('id_rekapitulasi_training', 'desc')->first();
            if(!$lastRow) {
                $id = 0;
            }
            else $id = $lastRow->id_rekapitulasi_training;
            $rt = new RekapitulasiTraining();
            $rt->id_training = $request->id_training;
            $rt->justifikasi = $request->justifikasi;
            $rt->nik_pegawai = $nik;
            $rt->jumlah_jam_training = $request->jumlah_jam_training;
            $rt->harga_training = $request->harga_training;
            $rt->invoice_training = $request->invoice_training;
            $rt->status_training = 'Diajukan';
            // dd($request->file('fpt_file'));
            if($request->file('fpt_file')){
                // fpt
                $dest_fpt = 'fpt/'.($id+1);
                $file_fpt = $request->file('fpt_file');
                $path_fpt = Storage::disk('public')->putFileAs($dest_fpt, $file_fpt, $file_fpt->getClientOriginalName());
                $rt->fpt_file = $path_fpt;
                $rt->status_training = 'FPT Disetujui';
            }
            if($request->file('pendaftaran_file')){
                // pendaftaran
                $dest_pendaftaran = 'pendaftaran/'.($id+1);
                $file_pendaftaran = $request->file('pendaftaran_file');
                $path_pendaftaran = Storage::disk('public')->putFileAs($dest_pendaftaran, $file_pendaftaran, $file_pendaftaran->getClientOriginalName());
                $rt->pendaftaran_file = $path_pendaftaran;
                $rt->status_training = 'Terdaftar';
            }
            if($request->file('undangan_file')){
                // undangan
                $dest_undangan = 'undangan/'.($id+1);
                $file_undangan = $request->file('undangan_file');
                $path_undangan = Storage::disk('public')->putFileAs($dest_undangan, $file_undangan, $file_undangan->getClientOriginalName());
                $rt->undangan_file = $path_undangan;
                $rt->status_training = 'Diundang';
            }
            if($request->file('absensi_file')){
                // absensi
                $dest_absensi = 'absensi/'.($id+1);
                $file_absensi = $request->file('absensi_file');
                $path_absensi = Storage::disk('public')->putFileAs($dest_absensi, $file_absensi, $file_absensi->getClientOriginalName());
                $rt->absensi_file = $path_absensi;
                $rt->status_training = 'Terlaksana';
            }
            if($request->file('sertifikat_file')){
                // sertifikat
                $dest_sertifikat = 'sertifikat/'.($id+1);
                $file_sertifikat = $request->file('sertifikat_file');
                $path_sertifikat = Storage::disk('public')->putFileAs($dest_sertifikat, $file_sertifikat, $file_sertifikat->getClientOriginalName());
                $rt->sertifikat_file = $path_sertifikat;
                $rt->status_training = 'Terlaksana';
            }
            if($request->file('invoice_file')){
                // invoice
                $dest_invoice = 'invoice/'.($id+1);
                $file_invoice = $request->file('invoice_file');
                $path_invoice = Storage::disk('public')->putFileAs($dest_invoice, $file_invoice, $file_invoice->getClientOriginalName());
                $rt->invoice_file = $path_invoice;
                $rt->status_training = 'Terlaksana';
            }
            if($request->file('eval_file')){
                // eval
                $dest_eval = 'eval/'.($id+1);
                $file_eval = $request->file('eval_file');
                $path_eval = Storage::disk('public')->putFileAs($dest_eval, $file_eval, $file_eval->getClientOriginalName());
                $rt->eval_file = $path_eval;
                $rt->status_training = 'Terlaksana';
            }
            $rt->biaya_lain = $request->biaya_lain/count($request->nik_pegawai);
            $rt->keterangan_lain = $request->keterangan_lain;
            // dd($rt);
            $rt->save();

            $lastRow = RekapitulasiTraining::orderBy('id_rekapitulasi_training', 'desc')->first();
            if(!$lastRow) {
                $id = 0;
            }
            else $id = $lastRow->id_rekapitulasi_training;

            $data = $request->tanggal_training;
            $dates = explode(",", $data);
            foreach ($dates as $d) {
                $tgl_train = new TanggalTraining();
                $lastRowtt = TanggalTraining::orderBy('id_tanggal_training', 'desc')->first();
                if(!$lastRowtt) {
                    $idtt = 0;
                }
                else $idtt = $lastRowtt->id_tanggal_training;
                $tgl_train->id_tanggal_training = $idtt + 1;
                $tgl_train->tanggal_training = $d;
                $tgl_train->save();

                $tgl_rekap = new TanggalRekapitulasi();
                $lastRowtr = TanggalRekapitulasi::orderBy('id_tanggal_rekapitulasi', 'desc')->first();
                if(!$lastRowtr) {
                    $idtr = 0;
                }
                else $idtr = $lastRowtr->id_tanggal_rekapitulasi;
                $tgl_rekap->id_rekapitulasi_training = $id;
                $tgl_rekap->id_tanggal_rekapitulasi = $idtr + 1;
                $tgl_rekap->id_tanggal_training = $idtt + 1;
                $tgl_rekap->save();
            }
            //cek periode
            $latest = RekapitulasiTraining::findorfail($id);
            $last = DB::select("select w.id_rekapitulasi_training, w.periode, w.id_training from rekapitulasi_training w where w.id_rekapitulasi_training = (select min(x.id_rekapitulasi_training) from maxmin_tanggal_training x where x.tgl_min = (select y.tgl_min from maxmin_tanggal_training y where y.id_rekapitulasi_training = '$latest->id_rekapitulasi_training'))");
            // dd($last);
            $x = $last[0]->id_training;
            if($last[0]->id_training == $latest->id_training){
                if($last[0]->periode == NULL){  
                    $maks = DB::select("select max(periode) as mx from rekapitulasi_training where id_training = '$x'");
                    $latest->periode = $maks[0]->mx + 1;
                    $latest->save();
                }
                else{
                    $latest->periode = $last[0]->periode;
                    $latest->save();
                }
            }
            else{
                $latest->periode = 1;
                $latest->save();
            }

        }
        return redirect()->route('rekapitulasiTraining');
        // return view('rekapitulasiTraining.tambahTanggal',compact('rt'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RekapitulasiTraining  $rekapitulasiTraining
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = RekapitulasiTraining::leftJoin('tanggal_rekapitulasi','tanggal_rekapitulasi.id_rekapitulasi_training','=','rekapitulasi_training.id_rekapitulasi_training')->leftJoin('tanggal_training','tanggal_training.id_tanggal_training','=','tanggal_rekapitulasi.id_tanggal_training')->where('rekapitulasi_training.id_rekapitulasi_training','=',$id)->orderBy('tanggal_training.tanggal_training','ASC')->get();
        return response()->json([
           'success' => true,
           'data' => $all
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RekapitulasiTraining  $rekapitulasiTraining
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $rt = RekapitulasiTraining::findorfail($id);
        $rt = RekapitulasiTraining::leftJoin('pegawai','pegawai.nik_pegawai','=','rekapitulasi_training.nik_pegawai')->leftJoin('training','training.id_training','=','rekapitulasi_training.id_training')->select('rekapitulasi_training.*','pegawai.nama_pegawai','pegawai.id_departemen','training.nama_training')->where('rekapitulasi_training.id_rekapitulasi_training','=',$id)->first();
        $pegawai = Pegawai::all();
        $training = Training::all();
        return view('rekapitulasiTraining.edit', compact('rt','pegawai','training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RekapitulasiTraining  $rekapitulasiTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idnow)
    {
        $validatedData = $request->validate([
            'justifikasi' => 'required',
            'jumlah_jam_training' => 'required',
            'harga_training' => 'required|numeric'
        ]);
        $lastRow = RekapitulasiTraining::orderBy('id_rekapitulasi_training', 'desc')->first();
        if(!$lastRow) {
            $id = 0;
        }
        else $id = $lastRow->id_rekapitulasi_training;
        $rt = RekapitulasiTraining::findorfail($idnow);
        $rt->justifikasi = $request->justifikasi;
        $rt->jumlah_jam_training = $request->jumlah_jam_training;
        $rt->harga_training = $request->harga_training;
        $rt->invoice_training = $request->invoice_training;
        // dd($request->file('fpt_file'));
        if($request->file('fpt_file')){
            // fpt
            $dest_fpt = 'fpt/'.($id+1);
            $file_fpt = $request->file('fpt_file');
            $path_fpt = Storage::disk('public')->putFileAs($dest_fpt, $file_fpt, $file_fpt->getClientOriginalName());
            $rt->fpt_file = $path_fpt;
            $rt->status_training = 'FPT Disetujui';
        }
        if($request->file('pendaftaran_file')){
            // pendaftaran
            $dest_pendaftaran = 'pendaftaran/'.($id+1);
            $file_pendaftaran = $request->file('pendaftaran_file');
            $path_pendaftaran = Storage::disk('public')->putFileAs($dest_pendaftaran, $file_pendaftaran, $file_pendaftaran->getClientOriginalName());
            $rt->pendaftaran_file = $path_pendaftaran;
            $rt->status_training = 'Terdaftar';
        }
        if($request->file('undangan_file')){
            // undangan
            $dest_undangan = 'undangan/'.($id+1);
            $file_undangan = $request->file('undangan_file');
            $path_undangan = Storage::disk('public')->putFileAs($dest_undangan, $file_undangan, $file_undangan->getClientOriginalName());
            $rt->undangan_file = $path_undangan;
            $rt->status_training = 'Diundang';
        }
        if($request->file('absensi_file')){
            // absensi
            $dest_absensi = 'absensi/'.($id+1);
            $file_absensi = $request->file('absensi_file');
            $path_absensi = Storage::disk('public')->putFileAs($dest_absensi, $file_absensi, $file_absensi->getClientOriginalName());
            $rt->absensi_file = $path_absensi;
            $rt->status_training = 'Terlaksana';
        }
        if($request->file('sertifikat_file')){
            // sertifikat
            $dest_sertifikat = 'sertifikat/'.($id+1);
            $file_sertifikat = $request->file('sertifikat_file');
            $path_sertifikat = Storage::disk('public')->putFileAs($dest_sertifikat, $file_sertifikat, $file_sertifikat->getClientOriginalName());
            $rt->sertifikat_file = $path_sertifikat;
            $rt->status_training = 'Terlaksana';
        }
        if($request->file('invoice_file')){
            // invoice
            $dest_invoice = 'invoice/'.($id+1);
            $file_invoice = $request->file('invoice_file');
            $path_invoice = Storage::disk('public')->putFileAs($dest_invoice, $file_invoice, $file_invoice->getClientOriginalName());
            $rt->invoice_file = $path_invoice;
            $rt->status_training = 'Terlaksana';
        }
        if($request->file('eval_file')){
            // eval
            $dest_eval = 'eval/'.($id+1);
            $file_eval = $request->file('eval_file');
            $path_eval = Storage::disk('public')->putFileAs($dest_eval, $file_eval, $file_eval->getClientOriginalName());
            $rt->eval_file = $path_eval;
            $rt->status_training = 'Terlaksana';
        }
        $rt->biaya_lain = $request->biaya_lain;
        $rt->keterangan_lain = $request->keterangan_lain;
        // dd($rt);
        $rt->save();
        return redirect()->route('rekapitulasiTraining');
    }

    public function storeTanggal(Request $request, $id)
    {
        $tgl_train = new TanggalTraining();
        $lastRowtt = TanggalTraining::orderBy('id_tanggal_training', 'desc')->first();
        if(!$lastRowtt) {
            $idtt = 0;
        }
        else $idtt = $lastRowtt->id_tanggal_training;
        $tgl_train->id_tanggal_training = $idtt + 1;
        $tgl_train->tanggal_training = $request->tanggal_training;
        $tgl_train->save();

        $tgl_rekap = new TanggalRekapitulasi();
        $lastRowtr = TanggalRekapitulasi::orderBy('id_tanggal_rekapitulasi', 'desc')->first();
        if(!$lastRowtr) {
            $idtr = 0;
        }
        else $idtr = $lastRowtr->id_tanggal_rekapitulasi;
        $tgl_rekap->id_rekapitulasi_training = $id;
        $tgl_rekap->id_tanggal_rekapitulasi = $idtr + 1;
        $tgl_rekap->id_tanggal_training = $idtt + 1;
        $tgl_rekap->save();
        return response()->json([
           'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RekapitulasiTraining  $rekapitulasiTraining
     * @return \Illuminate\Http\Response
     */
    public function rekapPeserta(Request $request)
    {
        RekapPeserta::truncate();
        $data = $request->data;
        foreach ($data as $d) { 
            if($d[4] == 'Terlaksana'){
                $rp = new RekapPeserta();
                $rp->tanggal_akhir = $d[2];
                $rp->nama_peserta = $d[5];
                $rp->nama_training = $d[7];
                $rp->jumlah_jam = $d[9];
                $rp->media = $d[10];
                $rp->periode = $d[25];
                $rp->save();
            }
        }
        return response()->json([
           'success' => true
        ]);
    }

    public function destroy($id)
    {
        RekapitulasiTraining::findorfail($id)->delete();
        return back();
    }

    public function destroyTanggal($id)
    {
        $tr = TanggalRekapitulasi::findorfail($id);
        TanggalTraining::findorfail($tr->id_tanggal_training)->delete();
        $tr->delete();
        return back();
    }
}
