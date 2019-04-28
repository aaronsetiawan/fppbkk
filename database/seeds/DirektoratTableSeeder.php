<?php

use Illuminate\Database\Seeder;
use App\Direktorat;

class DirektoratTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direktorat::create( [
		'nama_direktorat'=>'Direktur Utama',
		] );
    }
}
