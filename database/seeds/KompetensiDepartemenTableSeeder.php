<?php

use Illuminate\Database\Seeder;
use App\KompetensiDepartemen;

class KompetensiDepartemenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KompetensiDepartemen::create( [
		'id_kompetensi'=>'01',
		'id_departemen'=>'ACB1DEPT',
		'level_kompetensi'=>'1',
		'kompetensi_pendahulu'=>NULL
		] );

        KompetensiDepartemen::create( [
		'id_kompetensi'=>'02',
		'id_departemen'=>'ACB1DEPT',
		'level_kompetensi'=>'2',
		'kompetensi_pendahulu'=>'1'
		] );
    }
}
