<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                'title' => 'test 1',
                'body' => 'test body 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'test 2',
                'body' => 'test body 2',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
