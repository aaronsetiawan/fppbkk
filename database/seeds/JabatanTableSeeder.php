<?php

use Illuminate\Database\Seeder;
use App\Jabatan;

class JabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create( [
		'id_jabatan'=>'STAF',
		'nama_jabatan'=>'staff'
		] );
        Jabatan::create( [
		'id_jabatan'=>'PROF',
		'nama_jabatan'=>'prof'
		] );
        Jabatan::create( [
		'id_jabatan'=>'NSTF',
		'nama_jabatan'=>'ntsf'
		] );
        Jabatan::create( [
		'id_jabatan'=>'DEPH',
		'nama_jabatan'=>'deph'
		] );
        Jabatan::create( [
		'id_jabatan'=>'VP',
		'nama_jabatan'=>'vice president'
		] );
        Jabatan::create( [
		'id_jabatan'=>'PJS',
		'nama_jabatan'=>'pjs'
		] );

        Jabatan::create( [
		'id_jabatan'=>'SPEC',
		'nama_jabatan'=>'spec'
		] );

        Jabatan::create( [
		'id_jabatan'=>'SEAD',
		'nama_jabatan'=>'sead'
		] );

        Jabatan::create( [
		'id_jabatan'=>'DIVH',
		'nama_jabatan'=>'divh'
		] );

        Jabatan::create( [
		'id_jabatan'=>'ACT VP',
		'nama_jabatan'=>'act vp'
		] );

        Jabatan::create( [
		'id_jabatan'=>'ACT',
		'nama_jabatan'=>'act'
		] );

    }
}
