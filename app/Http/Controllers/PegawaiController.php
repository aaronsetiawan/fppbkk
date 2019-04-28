<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Jabatan;
use App\Departemen;
use App\Training;
use App\Kompetensi;
use App\KompetensiDepartemen;
use App\KompetensiJabatan;
use App\RekapitulasiTraining;
use Illuminate\Http\Request;
use DB;

class PegawaiController extends Controller
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
        $all = Pegawai::leftJoin('departemen', 'pegawai.id_departemen', '=', 'departemen.id_departemen')
        ->leftJoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->get();
        // dd($all);
        return view('pegawai.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        $departemen = Departemen::all();
        return view('pegawai.tambah', compact('departemen','jabatan'));
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
            'nik_pegawai' => 'required|unique:pegawai',
            'nama_pegawai' => 'required',
            'id_departemen' => 'required',
            'id_jabatan' => 'required',
        ]);
        $new = new Pegawai();
        $new->nik_pegawai = $request->nik_pegawai;
        $new->nama_pegawai = $request->nama_pegawai;
        $new->tanggal_masuk = $request->tanggal_masuk;
        $new->tanggal_keluar = $request->tanggal_keluar;
        $new->id_departemen = $request->id_departemen;
        $new->id_jabatan = $request->id_jabatan;
        $new->save();
        return redirect()->route('pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showKD($nik_pegawai)
    {
        $allkompdept = KompetensiDepartemen::leftJoin('departemen','departemen.id_departemen','=','kompetensi_departemen.id_departemen')->leftJoin('kompetensi','kompetensi.id_kompetensi','=','kompetensi_departemen.id_kompetensi')->leftJoin('pegawai','departemen.id_departemen','=','pegawai.id_departemen')->where('pegawai.nik_pegawai','=',$nik_pegawai)->select('kompetensi.nama_kompetensi','kompetensi_departemen.level_kompetensi')->orderBy('kompetensi_departemen.level_kompetensi')->get();

        $kd = KompetensiDepartemen::leftJoin('departemen','kompetensi_departemen.id_departemen','=','departemen.id_departemen')
        ->leftJoin('kompetensi','kompetensi_departemen.id_kompetensi','=','kompetensi.id_kompetensi')
        ->leftJoin('pegawai','departemen.id_departemen','=','pegawai.id_departemen')
        ->where('pegawai.nik_pegawai','=',$nik_pegawai)
        ->select('kompetensi_departemen.id_kompetensi')
        ->get();
        $done = Training::leftJoin('rekapitulasi_training','training.id_training','=','rekapitulasi_training.id_training')
        ->leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')
        ->leftJoin('kompetensi_departemen','kompetensi_departemen.id_kompetensi','kompetensi.id_kompetensi')
        ->whereIn('training.id_kompetensi',$kd)
        ->where('rekapitulasi_training.status_training','=','Terlaksana')
        ->where('rekapitulasi_training.nik_pegawai','=',$nik_pegawai)
        ->select('training.nama_training','kompetensi.nama_kompetensi','kompetensi_departemen.level_kompetensi')
        ->distinct()
        ->orderBy('kompetensi_departemen.level_kompetensi','ASC')
        ->get();

        $rk = RekapitulasiTraining::where('rekapitulasi_training.nik_pegawai','=',$nik_pegawai)->select('rekapitulasi_training.id_training')->get();
        $undone1 = Training::leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')
        ->leftJoin('kompetensi_departemen','kompetensi_departemen.id_kompetensi','kompetensi.id_kompetensi')
        ->whereNotIn('training.id_training',$rk)
        ->whereIn('training.id_kompetensi',$kd)
        ->select('training.nama_training','kompetensi.nama_kompetensi','kompetensi_departemen.level_kompetensi')
        ->distinct();
        // ->get();
        $undone2 = Training::leftJoin('rekapitulasi_training','training.id_training','=','rekapitulasi_training.id_training')
        ->leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')
        ->leftJoin('kompetensi_departemen','kompetensi_departemen.id_kompetensi','kompetensi.id_kompetensi')
        ->whereIn('training.id_kompetensi',$kd)
        ->where('rekapitulasi_training.status_training','<>','Terlaksana')
        ->select('training.nama_training','kompetensi.nama_kompetensi','kompetensi_departemen.level_kompetensi')
        ->distinct();
        // ->orderBy('kompetensi_departemen.level_kompetensi','ASC');
        // ->get();

        // ->YANG DI REKAP TRAININGBELUM TERLAKSANA DIUNION SAMA YANG GAADA DI REKAP TRAINING
        $undone = $undone1->union($undone2)->get();

        $peg = Pegawai::select('nama_pegawai')->where('nik_pegawai','=',$nik_pegawai)->get();
        // dd($peg);
        return view('pegawai.kompetensiDepartemen', compact('allkompdept','done','undone','peg'));
    }

    public function showKJ($nik_pegawai)
    {
        $allkompjab = KompetensiJabatan::leftJoin('jabatan','jabatan.id_jabatan','=','kompetensi_jabatan.id_jabatan')->leftJoin('kompetensi','kompetensi.id_kompetensi','=','kompetensi_jabatan.id_kompetensi')->leftJoin('pegawai','jabatan.id_jabatan','=','pegawai.id_jabatan')->where('pegawai.nik_pegawai','=',$nik_pegawai)->select('kompetensi.nama_kompetensi','kompetensi_jabatan.level_kompetensi')->orderBy('kompetensi_jabatan.level_kompetensi')->get();

        $kj = KompetensiJabatan::leftJoin('jabatan','kompetensi_jabatan.id_jabatan','=','jabatan.id_jabatan')
        ->leftJoin('kompetensi','kompetensi_jabatan.id_kompetensi','=','kompetensi.id_kompetensi')
        ->leftJoin('pegawai','jabatan.id_jabatan','=','pegawai.id_jabatan')
        ->where('pegawai.nik_pegawai','=',$nik_pegawai)
        ->select('kompetensi_jabatan.id_kompetensi')
        ->get();
        // dd($kj);
        $done = Training::leftJoin('rekapitulasi_training','training.id_training','=','rekapitulasi_training.id_training')
        ->leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')
        ->leftJoin('kompetensi_jabatan','kompetensi_jabatan.id_kompetensi','kompetensi.id_kompetensi')
        ->whereIn('training.id_kompetensi',$kj)
        ->where('rekapitulasi_training.nik_pegawai','=',$nik_pegawai)
        ->select('training.nama_training','kompetensi.nama_kompetensi','kompetensi_jabatan.level_kompetensi')
        ->distinct()
        ->orderBy('kompetensi_jabatan.level_kompetensi','ASC')
        ->get();

        $rk = RekapitulasiTraining::where('rekapitulasi_training.nik_pegawai','=',$nik_pegawai)->select('rekapitulasi_training.id_training')->get();
        $undone1 = Training::leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')
        ->leftJoin('kompetensi_jabatan','kompetensi_jabatan.id_kompetensi','kompetensi.id_kompetensi')
        ->whereNotIn('training.id_training',$rk)
        ->whereIn('training.id_kompetensi',$kj)
        ->select('training.nama_training','kompetensi.nama_kompetensi','kompetensi_jabatan.level_kompetensi')
        ->distinct();
        // ->orderBy('kompetensi_jabatan.level_kompetensi','ASC')
        // ->get();
       $undone2 = Training::leftJoin('rekapitulasi_training','training.id_training','=','rekapitulasi_training.id_training')
        ->leftJoin('kompetensi','kompetensi.id_kompetensi','=','training.id_kompetensi')
        ->leftJoin('kompetensi_jabatan','kompetensi_jabatan.id_kompetensi','kompetensi.id_kompetensi')
        ->whereIn('training.id_kompetensi',$kj)
        ->where('rekapitulasi_training.status_training','<>','Terlaksana')
        ->select('training.nama_training','kompetensi.nama_kompetensi','kompetensi_jabatan.level_kompetensi')
        ->distinct();

        $undone = $undone1->union($undone2)->get();
        $peg = Pegawai::select('nama_pegawai')->where('nik_pegawai','=',$nik_pegawai)->get();
        // dd($allkompjab);
        return view('pegawai.kompetensiJabatan', compact('allkompjab','done','undone','peg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nik_pegawai)
    {
        $r = Pegawai::findorfail($nik_pegawai);
        $r = Pegawai::leftJoin('departemen', 'pegawai.id_departemen', '=', 'departemen.id_departemen')
                        ->leftJoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id_jabatan')
                        ->where('pegawai.nik_pegawai','=',$nik_pegawai)
                        ->first();
        $jabatan = Jabatan::all();
        $departemen = Departemen::all();
        return view ('pegawai.edit',compact('r','departemen','jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik_pegawai)
    {
      $validatedData = $request->validate([
            'nik_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_departemen' => 'required',
            'id_jabatan' => 'required',
        ]);
        $r = Pegawai::findorfail($nik_pegawai);
        $r->nik_pegawai = $request->nik_pegawai;
        $r->nama_pegawai = $request->nama_pegawai;
        $r->tanggal_masuk = $request->tanggal_masuk;
        $r->tanggal_keluar = $request->tanggal_keluar;
        $r->id_departemen = $request->id_departemen;
        $r->id_jabatan = $request->id_jabatan;
        $r->save();
        return redirect()->route('pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik_pegawai)
    {
        Pegawai::findorfail($nik_pegawai)->delete();
        return back();
    }
}
