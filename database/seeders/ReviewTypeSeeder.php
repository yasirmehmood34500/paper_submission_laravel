<?php

namespace Database\Seeders;

use App\Models\ReviewType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $review_types = [
            ['name' => 'Minar Revision'],
            ['name' => 'Major Revision'],
        ];
        foreach ($review_types as $key => $value) {
            $already = ReviewType::withTrashed()->where('name', $value['name'])->first();
            if (!$already) {
                ReviewType::firstOrCreate(
                    ['name' => $value['name']]
                );
            }
        }
    }
}
