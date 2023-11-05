<?php

namespace Database\Seeders;

use App\Models\SubmissionFileType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionFileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_types = [
            ['name' => 'Abstract'],
            ['name' => 'Keywords'],
            ['name' => 'Methodology'],
            ['name' => 'Introduction'],
        ];
        foreach ($file_types as $key => $value) {
            SubmissionFileType::firstOrCreate(
                ['name' => $value['name']]
            );
        }
    }
}
