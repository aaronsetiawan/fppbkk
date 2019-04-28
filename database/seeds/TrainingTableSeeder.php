<?php

use Illuminate\Database\Seeder;
use App\Training;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Training::create( [
        'id_training'=>'1',
        'nama_training'=>'Customer Engagement',
        'id_media'=>'1',
        'id_topik'=>'K',
        'id_penyelenggara'=>'1',
		'id_kompetensi'=>'1',
		] );
        Training::create( [
        'id_training'=>'2',
        'nama_training'=>'Customer Service',
        'id_media'=>'1',
        'id_topik'=>'K',
        'id_penyelenggara'=>'1',
        'id_kompetensi'=>'1',
        ] );
        Training::create( [
        'id_training'=>'3',
        'nama_training'=>'Negotiation Skill',
        'id_media'=>'1',
        'id_topik'=>'K',
        'id_penyelenggara'=>'1',
        'id_kompetensi'=>'1',
        ] );
        Training::create( [
        'id_training'=>'4',
        'nama_training'=>'Lobbying',
        'id_media'=>'1',
        'id_topik'=>'K',
        'id_penyelenggara'=>'1',
        'id_kompetensi'=>'1',
        ] );
    }
}
