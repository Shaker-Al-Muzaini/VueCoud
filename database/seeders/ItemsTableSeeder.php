<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            ['name' => 'شاحن جوال سريع', 'category' => 'الكترونيات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'سماعة بلوتوث', 'category' => 'الكترونيات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'كتاب رواية', 'category' => 'كتب', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حقيبة ظهر', 'category' => 'أمتعة', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مظلة شمسية', 'category' => 'أمتعة', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

}
