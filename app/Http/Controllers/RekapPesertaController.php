<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RekapPeserta;
use App\Pegawai;
use DB;

class RekapPesertaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$all = RekapPeserta::all();
    	$giat = 'Giat';
    	$juara = 'Juara';

        $tgl_awal = RekapPeserta::select(DB::raw('date_add(min(rekap_peserta.tanggal_akhir), INTERVAL -(DAYOFWEEK(min(rekap_peserta.tanggal_akhir))-2) day) as tgl_awal'))->get();
        $tgl_akhir = RekapPeserta::select(DB::raw('date_add(max(rekap_peserta.tanggal_akhir), INTERVAL -(DAYOFWEEK(max(rekap_peserta.tanggal_akhir))-2) day) as tgl_akhir'))->get();
        $minggu_awal = RekapPeserta::select(DB::raw('week(date_add(min(rekap_peserta.tanggal_akhir), INTERVAL -(DAYOFWEEK(min(rekap_peserta.tanggal_akhir))-2) day)) as minggu_awal'))->get();
        $minggu_akhir = RekapPeserta::select(DB::raw('week(date_add(max(rekap_peserta.tanggal_akhir), INTERVAL -(DAYOFWEEK(max(rekap_peserta.tanggal_akhir))-2) day)) as minggu_akhir'))->get();
    	$data = RekapPeserta::select(DB::raw('date_add(rekap_peserta.tanggal_akhir, INTERVAL -(DAYOFWEEK(rekap_peserta.tanggal_akhir)-2) day) as per_tanggal, week(tanggal_akhir) as minggu, sum(jumlah_jam) as jmlh_jam, count(nama_peserta) as jmlh_peserta, count(distinct nama_peserta) as jmlh_pegawai_training'))->groupBy('minggu')->orderBy('per_tanggal','asc')->get();
        $kegiatan = RekapPeserta::select(DB::raw('week(tanggal_akhir) as minggu, count(nama_training) as jmlh_kegiatan'))->groupBy('minggu','periode','nama_training')->get();
        $peserta_giat = DB::select(DB::raw("select a.minggu, count(nama_peserta) as jmlh_peserta_giat from (select DISTINCT week(tanggal_akhir) as minggu from rekap_peserta) a left outer join rekap_peserta b on a.minggu = week(b.tanggal_akhir) and media = 'Giat' group by minggu"));
        $peserta_juara = DB::select(DB::raw("select a.minggu, count(nama_peserta) as jmlh_peserta_juara from (select DISTINCT week(tanggal_akhir) as minggu from rekap_peserta) a left outer join rekap_peserta b on a.minggu = week(b.tanggal_akhir) and media = 'Juara' group by minggu"));
    	// $pegawai = Pegawai::select(DB::raw('week(tanggal_masuk) as minggu_masuk, count(nik_pegawai) as jmlh_pegawai'))->groupBy('minggu_masuk')->get();

        $total = array(
            'jmlh_jam' => 0,
            'jmlh_peserta' => 0,
            'jmlh_pegawai_training' => 0,
            'jmlh_kegiatan' => 0,
            'jmlh_peserta_giat' => 0,
            'jmlh_peserta_juara' => 0,
            'total_pegawai' => 0,
            'jam_per_pegawai' => 0,
            'hari_per_pegawai' => 0
        );

        for ($i=0; $i < count($data); $i++) {
            $d = date($data[$i]->per_tanggal);
            $pegawai = DB::select(DB::raw("select count(nik_pegawai) as jmlh_pegawai from pegawai where tanggal_masuk <= '$d' and (tanggal_keluar is null or tanggal_keluar > '$d')"));
            // dd($data[$i]->per_tanggal);
            // dd($pegawai[0]->jmlh_pegawai);
            $jam_per_pegawai = round($data[$i]->jmlh_jam/$pegawai[0]->jmlh_pegawai,3);
            $hari_per_pegawai = round($jam_per_pegawai/8,3);
            $rekap2[$i] = array(
                'per_tanggal' => $data[$i]->per_tanggal,
                'minggu' => $data[$i]->minggu,
                'jmlh_jam' => $data[$i]->jmlh_jam,
                'jmlh_peserta' => $data[$i]->jmlh_peserta,
                'jmlh_pegawai_training' => $data[$i]->jmlh_pegawai_training,
                'jmlh_kegiatan' => $kegiatan[$i]->jmlh_kegiatan,
                'jmlh_peserta_giat' => $peserta_giat[$i]->jmlh_peserta_giat,
                'jmlh_peserta_juara' => $peserta_juara[$i]->jmlh_peserta_juara,
                'total_pegawai' => $pegawai[0]->jmlh_pegawai,
                'jam_per_pegawai' => $jam_per_pegawai,
                'hari_per_pegawai' => $hari_per_pegawai
            );
        }
        $d = date($tgl_awal[0]->tgl_awal);
        // dd($rekap2);
        for ($i = 0, $j = 0, $x = $minggu_awal[0]->minggu_awal; $x <= $minggu_akhir[0]->minggu_akhir; $x++, $j++){
            if($rekap2[$i]['minggu'] == $x){
                $rekap[$j] = array(
                    'per_tanggal' => $d,
                    'jmlh_jam' => $data[$i]->jmlh_jam,
                    'jmlh_peserta' => $data[$i]->jmlh_peserta,
                    'jmlh_pegawai_training' => $data[$i]->jmlh_pegawai_training,
                    'jmlh_kegiatan' => $kegiatan[$i]->jmlh_kegiatan,
                    'jmlh_peserta_giat' => $peserta_giat[$i]->jmlh_peserta_giat,
                    'jmlh_peserta_juara' => $peserta_juara[$i]->jmlh_peserta_juara,
                    'total_pegawai' => $pegawai[0]->jmlh_pegawai,
                    'jam_per_pegawai' => $jam_per_pegawai,
                    'hari_per_pegawai' => $hari_per_pegawai
                );
                $i ++;
            }
            else{
                $rekap[$j] = array(
                    'per_tanggal' => $d,
                    'jmlh_jam' => 0,
                    'jmlh_peserta' => 0,
                    'jmlh_pegawai_training' => 0,
                    'jmlh_kegiatan' => 0,
                    'jmlh_peserta_giat' => 0,
                    'jmlh_peserta_juara' => 0,
                    'total_pegawai' => 0,
                    'jam_per_pegawai' => 0,
                    'hari_per_pegawai' => 0
                );
            }
            $total = array(
                'jmlh_jam' => $total['jmlh_jam'] + $rekap[$j]['jmlh_jam'],
                'jmlh_peserta' => $total['jmlh_peserta'] + $rekap[$j]['jmlh_peserta'],
                'jmlh_pegawai_training' => $total['jmlh_pegawai_training'] + $rekap[$j]['jmlh_pegawai_training'],
                'jmlh_kegiatan' => $total['jmlh_kegiatan'] + $rekap[$j]['jmlh_kegiatan'],
                'jmlh_peserta_giat' => $total['jmlh_peserta_giat'] + $rekap[$j]['jmlh_peserta_giat'],
                'jmlh_peserta_juara' => $total['jmlh_peserta_juara'] + $rekap[$j]['jmlh_peserta_juara'],
                'total_pegawai' => $rekap[$j]['total_pegawai'],
                'jam_per_pegawai' => $total['jam_per_pegawai'] + $rekap[$j]['jam_per_pegawai'],
                'hari_per_pegawai' => $total['hari_per_pegawai'] + $rekap[$j]['hari_per_pegawai']
            );
            $d = date('Y-m-d', strtotime($d. ' + 7 days'));
        }
        // dd($total); 

    	return view('rekapPeserta', compact('all','rekap','total'));
    }
}
