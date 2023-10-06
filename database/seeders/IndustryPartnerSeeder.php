<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustryPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('industry_partners')->insert([
            'user_id' => 2,
            'approved' => true,
        ]);
        DB::table('industry_partners')->insert([
            'user_id' => 3,
            'approved' => true,
        ]);
        DB::table('industry_partners')->insert([
            'user_id' => 4,
            'approved' => true,
        ]);
        DB::table('industry_partners')->insert([
            'user_id' => 5,
            'approved' => true,
        ]);
        DB::table('industry_partners')->insert([
            'user_id' => 6,
            'approved' => true,
        ]);
        DB::table('industry_partners')->insert([
            'user_id' => 7,
            'approved' => false,
        ]);
        DB::table('industry_partners')->insert([
            'user_id' => 8,
            'approved' => false,
        ]);
    }
}
