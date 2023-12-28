<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('survey')->insert([
            [
                'nama_bisnis' => 'Bisnis Narkoba',
                'jenis_usaha' => 'Ilegal',
                'nama_pic' => 'Arip',
                'no_hp' => '082738193723',
                'no_pelanggan' => '912392749',
                'alamat' => 'Wanareja',
                'foto' => '',
                'status' => 'none',
            ],
            [
                'nama_bisnis' => 'Bisnis Prostitusi',
                'jenis_usaha' => 'penjualan manusia',
                'nama_pic' => 'Kopeng',
                'no_hp' => '08236728374',
                'no_pelanggan' => '98727373',
                'alamat' => 'Teluk',
                'foto' => '',
                'status' => 'none',
            ],
            [
                'nama_bisnis' => 'Bisnis Kolam Renang',
                'jenis_usaha' => 'kolam',
                'nama_pic' => 'Sido',
                'no_hp' => '08293023821',
                'no_pelanggan' => '9263126137',
                'alamat' => 'Puri',
                'foto' => '',
                'status' => 'none',
            ],
            
        ]);
    }
    }

