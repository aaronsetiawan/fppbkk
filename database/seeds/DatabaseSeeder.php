<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AnggaranTableSeeder::class);
        $this->call(DirektoratTableSeeder::class);
        $this->call(DivisiTableSeeder::class);
        $this->call(DepartemenTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(TopikTableSeeder::class);
        $this->call(PenyelenggaraTableSeeder::class);
        $this->call(KompetensiTableSeeder::class);
        $this->call(TrainingTableSeeder::class);
        $this->call(JabatanTableSeeder::class);
        $this->call(KompetensiDepartemenTableSeeder::class);
        $this->call(KompetensiJabatanTableSeeder::class);
        $this->call(PegawaiTableSeeder::class);
        $this->call(TanggalTrainingTableSeeder::class);
        $this->call(RekapitulasiTrainingTableSeeder::class);
        $this->call(TanggalRekapitulasiTableSeeder::class);
    }
}
