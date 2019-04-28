<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use DB;
// use Validator;
use Illuminate\Support\Facades\Validator;


class MediaController extends Controller
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
        $all = Media::orderBy('nama_media', 'ASC')->get();
        return view('media.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new Media();
        Validator::extend('uniqueMediaandKategoriMedia', function ($attribute, $value, $parameters, $validator) {
        $count = DB::table('media')->where('nama_media', $value)
                                ->where('kategori_media', $parameters[0])
                                ->count();

        return $count === 0;
        });
        $validatedData = $request->validate([
            'nama_media' => "uniqueMediaandKategoriMedia:{$request->kategori_media}|required",
        ]);
        $new->nama_media = $request->nama_media;
        $new->kategori_media = $request->kategori_media;
        $new->save();
        return redirect()->route('media');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_media)
    {
        $r = Media::findorfail($id_media);
        return view ('media.edit',compact('r'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_media)
    {
        $r = Media::findorfail($id_media);
        Validator::extend('uniqueMediaandKategoriMedia', function ($attribute, $value, $parameters, $validator) {
        $count = DB::table('media')->where('nama_media', $value)
                                ->where('kategori_media', $parameters[0])
                                ->count();

        return $count === 0;
        });
        $validatedData = $request->validate([
            'nama_media' => "uniqueMediaandKategoriMedia:{$request->kategori_media}|required",
        ]);
        $r->nama_media = $request->nama_media;
        $r->kategori_media = $request->kategori_media;
        $r->save();
        return redirect()->route('media');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_media)
    {
        Media::findorfail($id_media)->delete();
        return back();
    }
    // public function validateUniqueProjectUser($attribute, $value, $parameters, $validator)
    // { 
    //     $inputs = $validator->getData(); $projectId = $inputs['project_id']; $numDupes = ProjectUser::where([ 'project_id' => $projectId, 'uid' => $value ])->count(); return ($numDupes > 0); } AppServiceProvider: Validator::extend('unique_security', 'App\Validators\CustomValidator@validateUniqueProjectUser'); Apply rule: public static $rules = array( 'UID' => 'required|unique_project_user' );
}
