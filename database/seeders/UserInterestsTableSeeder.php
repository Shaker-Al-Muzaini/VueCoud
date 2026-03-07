<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_interests')->insert([
            ['user_id' => 1, 'item_id' => 1, 'created_at' => now(), 'updated_at' => now()], // علي مهتم بالشاحن
            ['user_id' => 1, 'item_id' => 2, 'created_at' => now(), 'updated_at' => now()], // علي مهتم بالسماعة
            ['user_id' => 2, 'item_id' => 3, 'created_at' => now(), 'updated_at' => now()], // سارة مهتمة بالكتب
        ]);
    }

}
