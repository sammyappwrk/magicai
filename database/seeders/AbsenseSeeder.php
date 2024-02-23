<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Absense;
class AbsenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Absense::create(
            [
            'section_name' => 'landing-header-section',
            'content' => '',
            'status' => 1,
            ]);
            Absense::create(
                [
                'section_name' => 'landing-footer-section',
                'content' => '',
                'status' => 1,
                ]);
    }
}
