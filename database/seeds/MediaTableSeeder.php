<?php

use Illuminate\Database\Seeder;
use App\Media;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::create( [
		'id_media'=>'1',
		'nama_media'=>'Giat',
		'kategori_media'=>'Inhouse'
		] );
        Media::create( [
		'id_media'=>'2',
		'nama_media'=>'Giat',
		'kategori_media'=>'Publik'
		] );
        Media::create( [
		'id_media'=>'3',
		'nama_media'=>'Juara',
		'kategori_media'=>'Inhouse'
		] );
        Media::create( [
		'id_media'=>'4',
		'nama_media'=>'Giat',
		'kategori_media'=>'Publik'
		] );
        Media::create( [
		'id_media'=>'5',
		'nama_media'=>'Rajin',
		'kategori_media'=>'Inhouse'
		] );
        Media::create( [
		'id_media'=>'6',
		'nama_media'=>'Rajin',
		'kategori_media'=>'Publik'
		] );
    }
}
