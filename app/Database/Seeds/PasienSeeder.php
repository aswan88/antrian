<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class PasienSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'nik' => '3457192744354354',
            'nama' => 'La Aswan ',
            'tempat_lahir' => 'gunung tinggi',
            'tanggal_lahir' => '25/10/1999',
            'umur' => '22',
            'jk' => 'Laki-Laki',
            'agama' => 'Islam',
            'alamat' => 'Jl.001 Air Salak',
            'email'    => 'aswan@gmail.com',
            'password'    => 'sandi',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),

        ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)",
        //         $data
        // );

        // Using Query Builder
        $this->db->table('pasien')->insert($data);
    }
}
