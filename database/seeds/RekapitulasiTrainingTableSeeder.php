<?php

use Illuminate\Database\Seeder;
use App\RekapitulasiTraining;

class RekapitulasiTrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	RekapitulasiTraining::create( [
        'id_rekapitulasi_training'=>'1',
        'nik_pegawai'=>'0614887',
        'status_training'=>'Terlaksana',
        'justifikasi'=>'TNA',
        'jumlah_jam_training'=>'5',
        'periode'=>'1',
        'harga_training'=>'5000000',
        'invoice_training'=>'5000000',
        'fpt_file'=>'',
        'pendaftaran_file'=>'',
        'undangan_file'=>'',
        'absensi_file'=>'',
        'sertifikat_file'=>'',
        'eval_file'=>'',
        'invoice_file'=>'',
        'biaya_lain'=>'500000',
        'keterangan_lain'=>'biaya lain untuk transport',
        'id_training'=>'01'
    	]);
        RekapitulasiTraining::create( [
        'id_rekapitulasi_training'=>'2',
        'nik_pegawai'=>'0215918',
        'status_training'=>'Terlaksana',
        'justifikasi'=>'HOHO',
        'jumlah_jam_training'=>'4',
        'periode'=>'1',
        'harga_training'=>'500000',
        'invoice_training'=>'400000',
        'fpt_file'=>'',
        'pendaftaran_file'=>'',
        'undangan_file'=>'',
        'absensi_file'=>'',
        'sertifikat_file'=>'',
        'eval_file'=>'',
        'invoice_file'=>'',
        'biaya_lain'=>'500000',
        'keterangan_lain'=>'biaya lain untuk transport',
        'id_training'=>'02'
        ]);
        RekapitulasiTraining::create( [
        'id_rekapitulasi_training'=>'3',
        'nik_pegawai'=>'0312779',
        'status_training'=>'Diajukan',
        'justifikasi'=>'HEHE',
        'jumlah_jam_training'=>'3',
        'periode'=>'1',
        'harga_training'=>'900000',
        'invoice_training'=>'900000',
        'fpt_file'=>'',
        'pendaftaran_file'=>'',
        'undangan_file'=>'',
        'absensi_file'=>'',
        'sertifikat_file'=>'',
        'eval_file'=>'',
        'invoice_file'=>'',
        'biaya_lain'=>'500000',
        'keterangan_lain'=>'biaya lain untuk transport',
        'id_training'=>'03'
        ]);

        RekapitulasiTraining::create( [
        'id_rekapitulasi_training'=>'4',
        'nik_pegawai'=>'0316942',
        'status_training'=>'Diajukan',
        'justifikasi'=>'HAHA',
        'jumlah_jam_training'=>'2',
        'periode'=>'1',
        'harga_training'=>'1000000',
        'invoice_training'=>'1000000',
        'fpt_file'=>'',
        'pendaftaran_file'=>'',
        'undangan_file'=>'',
        'absensi_file'=>'',
        'sertifikat_file'=>'',
        'eval_file'=>'',
        'invoice_file'=>'',
        'biaya_lain'=>'500000',
        'keterangan_lain'=>'biaya lain untuk transport',
        'id_training'=>'03'
        ]);
    }
}
