<?php

namespace Database\Seeders;

use App\Models\SubmissionRequirement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submission_requirements = [
            [
                'text' => 'The submission has not been previously published, nor is it before another journal for consideration (or an explanation has been provided in Comments to the Editor).',
            ],
            [
                'text' => 'The submission file is in OpenOffice, Microsoft Word, or RTF document file format.',
            ],
            [
                'text' => 'Where available, URLs for the references have been provided.',
            ],
            [
                'text' => 'The text is single-spaced; uses a 12-point font; employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables are placed within the text at the appropriate points, rather than at the end.',
            ],
            [
                'text' => 'The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines.',
            ],
        ];
        foreach ($submission_requirements as $key => $value) {
            SubmissionRequirement::firstOrCreate(
                ['text' => $value['text']],
                [
                    'text' => $value['text'],
                ]
            );
        }
    }
}
