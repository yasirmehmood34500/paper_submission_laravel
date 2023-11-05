<?php

namespace Database\Seeders;

use App\Models\AuthorContributorRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorContributorRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contributor_rules = [
            ['name' => 'Co Author'],
            ['name' => 'Translator'],
        ];
        foreach ($contributor_rules as $key => $value) {
            AuthorContributorRule::firstOrCreate(
                ['name' => $value['name']]
            );
        }
    }
}
