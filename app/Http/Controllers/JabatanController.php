<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\KompetensiJabatan;
use App\Kompetensi;
use Illuminate\Http\Request;
use DB;

class JabatanController extends Controller
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
        $all = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        return view('jabatan.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.tambah');
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
            'id_jabatan' => 'required|unique:jabatan|max:50',
            'nama_jabatan' => 'required|unique:jabatan',
        ]);
        $new = new Jabatan();
        $new->id_jabatan = $request->id_jabatan;
        $new->nama_jabatan = $request->nama_jabatan;
        $new->save();
        return redirect()->route('jabatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_jabatan)
    {
        $id_now = $id_jabatan;
        $jab_now = Jabatan::select('nama_jabatan')->where('id_jabatan','=',$id_jabatan)->get();
        $all = KompetensiJabatan::where('id_jabatan','=',$id_jabatan)->leftJoin('kompetensi as komp','komp.id_kompetensi','=','kompetensi_jabatan.id_kompetensi')->leftJoin('kompetensi as pend','pend.id_kompetensi','=','kompetensi_jabatan.kompetensi_pendahulu')->select('kompetensi_jabatan.*','komp.*','pend.nama_kompetensi as nama_kompetensi_pendahulu')->orderBy('kompetensi_jabatan.level_kompetensi','ASC')->get();
        return view('jabatan.kompetensi', compact('all','id_now','jab_now'));
    }

    public function tambahKompetensi()
    {
        $komp = Kompetensi::all();
        return response()->json([
           'success' => true,
           'data' => $komp
        ]);
    }

    public function editKompetensi($idjab, $id)
    {
        $nih = KompetensiJabatan::leftJoin('kompetensi as komp','komp.id_kompetensi','=','kompetensi_jabatan.id_kompetensi')->leftJoin('kompetensi as pend','pend.id_kompetensi','=','kompetensi_jabatan.kompetensi_pendahulu')->select('kompetensi_jabatan.*','komp.*','pend.id_kompetensi as id_kompetensi_pendahulu','pend.nama_kompetensi as nama_kompetensi_pendahulu')->where('kompetensi_jabatan.id_kompetensi_jabatan','=',$id)->first();
        $komp = Kompetensi::all();
        return response()->json([
           'success' => true,
           'data' => $komp,
           'now' => $nih
        ]);
    }

    public function storeKompetensi(Request $request, $id)
    {
        $kd = new KompetensiJabatan();
        $kd->id_jabatan = $id;
        $kd->id_kompetensi = $request->id_kompetensi;
        $kd->level_kompetensi = $request->level_kompetensi;
        $kd->kompetensi_pendahulu = $request->kompetensi_pendahulu;
        $kd->save();
        return response()->json([
           'success' => true,
           'data' => $kd
        ]);
    }

    public function updateKompetensi(Request $request, $idjab, $id)
    {
        $kd = KompetensiJabatan::findorfail($id);
        $kd->id_jabatan = $idjab;
        $kd->id_kompetensi = $request->id_kompetensi;
        $kd->level_kompetensi = $request->level_kompetensi;
        $kd->kompetensi_pendahulu = $request->kompetensi_pendahulu;
        $kd->save();
        return response()->json([
           'success' => true,
           'data' => $kd
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jabatan)
    {
        $r = Jabatan::findorfail($id_jabatan);
        return view ('jabatan.edit',compact('r'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jabatan)
    {
        $r = Jabatan::findorfail($id_jabatan);
        $validatedData = $request->validate([
            'id_jabatan' => 'required|unique:jabatan',
            'nama_jabatan' => 'required|unique:jabatan',
        ]);
        $r->id_jabatan = $request->id_jabatan;
        $r->nama_jabatan = $request->nama_jabatan;
        $r->save();
        return redirect()->route('jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jabatan)
    {
        Jabatan::findorfail($id_jabatan)->delete();
        return back();
    }

    public function destroyKompetensi($id)
    {
        KompetensiJabatan::findorfail($id)->delete();
        return back();
    }
}
