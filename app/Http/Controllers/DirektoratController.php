<?php

namespace App\Http\Controllers;

use App\Direktorat;
use Illuminate\Http\Request;
use DB;

class DirektoratController extends Controller
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
        $all = Direktorat::orderBy('nama_direktorat', 'ASC')->get();
        return view('direktorat.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('direktorat.tambah');
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
            'nama_direktorat' => 'required|unique:direktorat',
        ]);
        $new = new Direktorat();
        $new->nama_direktorat = $request->nama_direktorat;
        $new->save();
        return redirect()->route('direktorat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_direktorat)
    {
        $all = Direktorat::leftJoin('divisi','divisi.id_direktorat','=','direktorat.id_direktorat')->where('direktorat.id_direktorat','=',$id_direktorat)->get();
        // console.log($all);
        return response()->json([
           'success' => true,
           'data' => $all
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_direktorat)
    {
        $r = Direktorat::findorfail($id_direktorat);
        return view ('direktorat.edit',compact('r'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_direktorat)
    {
        $r = Direktorat::findorfail($id_direktorat);
        $validatedData = $request->validate([
            'nama_direktorat' => 'required|unique:direktorat',
        ]);
        $r->nama_direktorat = $request->nama_direktorat;
        $r->save();
        return redirect()->route('direktorat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_direktorat)
    {
        Direktorat::findorfail($id_direktorat)->delete();
        return back();
    }
}
