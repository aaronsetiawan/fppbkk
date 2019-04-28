<?php

namespace App\Http\Controllers;

use App\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
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
        $all = Kompetensi::orderBy('id_kompetensi','ASC')->get();
        return view('kompetensi.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kompetensi.tambah');
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
            'id_kompetensi' => 'required|unique:kompetensi|max:2',
            'nama_kompetensi' => 'required|unique:kompetensi',
        ]);
        $komp = new Kompetensi();
        $komp->id_kompetensi = $request->id_kompetensi;
        $komp->nama_kompetensi = $request->nama_kompetensi;
        $komp->save();
        return redirect()->route('kompetensi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function show(Kompetensi $kompetensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komp = Kompetensi::findorfail($id);
        return view('kompetensi.edit', compact('komp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $komp = Kompetensi::findorfail($id);
        $validatedData = $request->validate([
            'id_kompetensi' => 'required|max:2',
            'nama_kompetensi' => 'required',
        ]);
        $komp->id_kompetensi = $request->id_kompetensi;
        $komp->nama_kompetensi = $request->nama_kompetensi;
        $komp->save();
        return redirect()->route('kompetensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kompetensi::findorfail($id)->delete();
        return back();
    }
}
