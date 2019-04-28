<?php

use Illuminate\Database\Seeder;
use App\KompetensiJabatan;

class KompetensiJabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KompetensiJabatan::create( [
		'id_kompetensi'=>'01',
		'id_jabatan'=>'STAF',
		'level_kompetensi'=>'1',
		'kompetensi_pendahulu'=>NULL
		] );

        KompetensiJabatan::create( [
		'id_kompetensi'=>'02',
		'id_jabatan'=>'STAF',
		'level_kompetensi'=>'2',
		'kompetensi_pendahulu'=>'1'
		] );
    }
}
