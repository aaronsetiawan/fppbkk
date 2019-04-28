<?php

use Illuminate\Database\Seeder;
use App\Anggaran;

class AnggaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Anggaran::create( [
        'id_anggaran'=>'00',
		'tahun_anggaran'=>'2015',
		'jumlah_anggaran'=>'200000000'
		] );
        Anggaran::create( [
        'id_anggaran'=>'02',
		'tahun_anggaran'=>'2016',
		'jumlah_anggaran'=>'250000000'
		] );
        Anggaran::create( [
        'id_anggaran'=>'03',
		'tahun_anggaran'=>'2017',
		'jumlah_anggaran'=>'270000000'
		] );
        Anggaran::create( [
        'id_anggaran'=>'04',
		'tahun_anggaran'=>'2018',
		'jumlah_anggaran'=>'255000000'
		] );
    }
}
