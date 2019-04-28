<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Direktorat;
use App\Departemen;
use DB;
use Illuminate\Http\Request;

class DivisiController extends Controller
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
        $all = Divisi::leftJoin('direktorat', 'direktorat.id_direktorat', '=', 'divisi.id_direktorat')->orderBy('nama_divisi')->get();
        // dd($all);
        return view('divisi.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $direktorat = Direktorat::all();
        return view('divisi.tambah', compact('direktorat'));
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
            'id_divisi' => 'required|unique:divisi',
            'nama_divisi' => 'required',
            'id_direktorat' => 'required',
        ]);
        $divisi = new Divisi();
        $divisi->id_divisi = $request->id_divisi;
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->id_direktorat = $request->id_direktorat;
        $divisi->save();
        return redirect()->route('divisi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = Divisi::leftJoin('departemen','departemen.id_divisi','=','divisi.id_divisi')->where('divisi.id_divisi','=',$id)->get();
        // console.log($all);
        return response()->json([
           'success' => true,
           'data' => $all
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisi = Divisi::leftJoin('direktorat', 'direktorat.id_direktorat', '=', 'divisi.id_direktorat')
                        ->where('divisi.id_divisi','=',$id)
                        ->first();
        $direktorat = Direktorat::all();
        return view('divisi.edit', compact('divisi','direktorat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_divisi' => 'required',
            'nama_divisi' => 'required',
            'id_direktorat' => 'required',
        ]);
        $divisi = Divisi::findorfail($id);
        $divisi->id_divisi = $request->id_divisi;
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->id_direktorat = $request->id_direktorat;
        $divisi->save();
        return redirect()->route('divisi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Divisi::findorfail($id)->delete();
        return back();
    }
}
