<?php

namespace App\Http\Controllers;

use App\Topik;
use Illuminate\Http\Request;
use DB;

class TopikController extends Controller
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
        $all = Topik::orderBy('nama_topik', 'ASC')->get();
        return view('topik.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topik.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new Topik();
        $validatedData = $request->validate([
            'id_topik' => 'required|unique:topik|max:1',
            'nama_topik' => 'required|unique:topik',
        ]);
        $new->id_topik = $request->id_topik;
        $new->nama_topik = $request->nama_topik;
        $new->save();
        return redirect()->route('topik');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_topik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_topik)
    {
        $r = Topik::findorfail($id_topik);
        return view ('topik.edit',compact('r'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_topik)
    {
        $r = Topik::findorfail($id_topik);
        $validatedData = $request->validate([
            'id_topik' => 'required|max:1',
            'nama_topik' => 'required|unique:topik',
        ]);
        $r->id_topik = $request->id_topik;
        $r->nama_topik = $request->nama_topik;
        $r->save();
        return redirect()->route('topik');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_topik)
    {
        Topik::findorfail($id_topik)->delete();
        return back();
    }
}
