<?php

use Illuminate\Database\Seeder;
use App\Divisi;

class DivisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::create( [
		'id_divisi'=>'ITO2DIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'IT Operation 2 Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'ACBDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Acquiring Business Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'BODB',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Bord of Director Business'
		] );


					
		Divisi::create( [
		'id_divisi'=>'BODIT',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Bord of Director IT'
		] );


					
		Divisi::create( [
		'id_divisi'=>'BODFS',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Bord of Director Finance &  Corporate Service'
		] );


					
		Divisi::create( [
		'id_divisi'=>'ITDDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Information Technology Development Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'GSEDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'GENERAL SERVICES DIVISION'
		] );


					
		Divisi::create( [
		'id_divisi'=>'ITO1DIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'IT Operation 1 Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'HCMDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Human Capital Management Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'COPDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Commercial Payment Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'CIDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Cards Issuing Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'COSDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Corporate Secretary Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'COMDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Commercial  Corporate Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'MSEDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Managed Services Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'FADIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'FINANCE AND ACCOUNTING DIVISION'
		] );


					
		Divisi::create( [
		'id_divisi'=>'SBSDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Switching Business Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'CSTDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Corporate Strategy Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'BODS',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Board of Director Support'
		] );


					
		Divisi::create( [
		'id_divisi'=>'COBDIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Commercial Banking Division'
		] );


					
		Divisi::create( [
		'id_divisi'=>'SEODIV',
		'id_direktorat'=>'1',
		'nama_divisi'=>'Service Operation Division'
		] );
    }
}
