<?php

namespace App\Http\Controllers;

use App\Penyelenggara;
use Illuminate\Http\Request;
use DB;

class PenyelenggaraController extends Controller
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
        $all = Penyelenggara::orderBy('nama_penyelenggara', 'ASC')->get();
        return view('penyelenggara.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penyelenggara.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new Penyelenggara();
        $validatedData = $request->validate([
            'nama_penyelenggara' => 'required|unique:penyelenggara',
        ]);
        $new->nama_penyelenggara = $request->nama_penyelenggara;
        $new->save();
        return redirect()->route('penyelenggara');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_penyelenggara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_penyelenggara)
    {
        $r = Penyelenggara::findorfail($id_penyelenggara);
        return view ('penyelenggara.edit',compact('r'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_penyelenggara)
    {
        $r = Penyelenggara::findorfail($id_penyelenggara);
        $validatedData = $request->validate([
            'nama_penyelenggara' => 'required|unique:penyelenggara',
        ]);        
        $r->nama_penyelenggara = $request->nama_penyelenggara;
        $r->save();
        return redirect()->route('penyelenggara');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_penyelenggara)
    {
        Penyelenggara::findorfail($id_penyelenggara)->delete();
        return back();
    }
}
