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
        $amazon = DB::table('users')->where('name', 'Amazon')->first();
        $industryPartners= DB::table('users')->where('type', 'Industry Partner')->get();
        foreach ($industryPartners as $industryPartner) {
            DB::table('industry_partners')->insert([
                'user_id' => $industryPartner->id,
                'approved' => $industryPartner->name === 'Amazon' || $industryPartner->name === 'Facebook' || $industryPartner->name === 'Google' || $industryPartner->name === 'Microsoft' || $industryPartner->name === 'Apple', // Amazon, Facebook, Google, Microsoft, Apple are approved
                'created_at' => now(),
            ]);
        }
    }
}
