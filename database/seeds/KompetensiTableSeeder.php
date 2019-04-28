<?php

use Illuminate\Database\Seeder;
use App\Kompetensi;

class KompetensiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kompetensi::create( [
		'id_kompetensi'=>'1',
		'nama_kompetensi'=>'Finance'
		] );
        Kompetensi::create( [
		'id_kompetensi'=>'2',
		'nama_kompetensi'=>'Manajemen'
		] );
        Kompetensi::create( [
		'id_kompetensi'=>'3',
		'nama_kompetensi'=>'Teknologi'
		] );
        Kompetensi::create( [
		'id_kompetensi'=>'4',
		'nama_kompetensi'=>'Public Speaking'
		] );
    }
}
