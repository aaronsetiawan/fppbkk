<?php

use Illuminate\Database\Seeder;
use App\Topik;

class TopikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topik::create( [
		'id_topik'=>'K',
		'nama_topik'=>'Akrab'
		] );
        Topik::create( [
		'id_topik'=>'P',
		'nama_topik'=>'Apik'
		] );
        Topik::create( [
		'id_topik'=>'S',
		'nama_topik'=>'Asik'
		] );
        Topik::create( [
		'id_topik'=>'J',
		'nama_topik'=>'Ajib'
		] );
    }
}
