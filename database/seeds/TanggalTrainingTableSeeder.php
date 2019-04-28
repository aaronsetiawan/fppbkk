<?php

use Illuminate\Database\Seeder;
use App\TanggalTraining;

class TanggalTrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TanggalTraining::create( [
        	'id_tanggal_training' => '1',
        	'tanggal_training' => '2018-07-19'
        ] );
        TanggalTraining::create( [
        	'id_tanggal_training' => '2',
        	'tanggal_training' => '2018-07-31'
        ] );
        TanggalTraining::create( [
            'id_tanggal_training' => '3',
            'tanggal_training' => '2018-11-20'
        ] );
        TanggalTraining::create( [
            'id_tanggal_training' => '4',
            'tanggal_training' => '2018-11-15'
        ] );
        TanggalTraining::create( [
            'id_tanggal_training' => '5',
            'tanggal_training' => '2018-11-09'
        ] );

    }
}
