<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'nama' => 'Admin',
            'no_hp' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'remember_token' => Str::random(10),
            'level' => 1
        ]);

        \App\Models\ProfilInstansi::create([
            'nama_instansi' => 'PT. MATRIECS CIPTA ANUGERAH',
            'deskripsi' => 'PT. Matriecs Cipta Anugerah adalah Perusahaan yang bergerak dalam Bidang Properti didirikan pada tanggal  15 Agustus 2012. Berkantor Pusat di Manokwari (Papua Barat) dan kami telah melakukan Pembangunan Perumahan Subsidi serta Komersil Bekerja sama sebagai konsutan dengan PT. Indah Asri Persada, antara lain : Arfai Salak Residence, Arfai Indah Regency, Susweni Indah Asri, Anggori Persada Regency. Adapun gambarannya seperti di bawah ini dan sampai saat ini Perusahaan kami juga masih bekerjasama dalam Consultant Marketing',
            'latitude' => '-3.6494248981584794',
            'longitude' => '128.19396737970573',
            'kode_pos' => '76890',
            'alamat' => 'Jl. Air Mata Cina, Urimessing',
            'email' => 'matriecsciptaanugerah@gmail.com',
            'telepon' => '085254100351',
            'logo' => '',
        ]);
    }
}
