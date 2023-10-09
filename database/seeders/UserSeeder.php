<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Teacher (aka admin)
        DB::table('users')->insert([
            'name' => 'Hannah',
            'email' => 'hannaheichelsdoerfer@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Teacher',
            'created_at' => now(),
        ]);
        // Industry Partners
        DB::table('users')->insert([
            'name' => 'Zalando',
            'email' => 'hiring@zalando.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Amazon',
            'email' => 'representative@amazon.com.au',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Google',
            'email' => 'hiringmanager@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Microsoft',
            'email' => 'hiring@microsoft.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Apple',
            'email' => 'hiring@icloud.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Facebook',
            'email' => 'hiring@meta.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Tesla',
            'email' => 'elon@tesla.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(), // UserTypeEnum::INDUSTRY_PARTNER,
        ]);
        DB::table('users')->insert([
            'name' => 'Canva',
            'email' => 'apply@canva.au',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Atlassian',
            'email' => 'hiring@atlassian.com',
            'password' => bcrypt('123456'),
            'type' => 'Industry Partner',
            'created_at' => now(),
        ]);
        // Students
        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Alexandra',
            'email' => 'alexandra@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Steven',
            'email' => 'steven@yahoo.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Elena',
            'email' => 'elena@hotmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Matthew',
            'email' => 'matthew@smith.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
            'created_at' => now(),
        ]);
    }
}
