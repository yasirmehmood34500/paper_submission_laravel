<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Add Author',
                'key' => 'add_author',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View Author',
                'key' => 'view_author',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Add Reviewer',
                'key' => 'add_reviewer',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View Reviewer',
                'key' => 'view_reviewer',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View All Submission',
                'key' => 'view_all_submission',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'New Paper Submission',
                'key' => 'new_paper_submission',
                'user_level' => User::AUTHOR,
            ],
            [
                'name' => 'My Submission',
                'key' => 'author_my_submission',
                'user_level' => User::AUTHOR,
            ],
            [
                'name' => 'My Draft Submission',
                'key' => 'author_my_draft_submission',
                'user_level' => User::AUTHOR,
            ],
            [
                'name' => 'Add Contributor Roles',
                'key' => 'add_contributor_rule',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View Contributor Roles',
                'key' => 'view_contributor_rule',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Add Paper File Type',
                'key' => 'add_paper_file_type',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View Paper File Type',
                'key' => 'view_paper_file_type',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Add Paper Submission Requirement',
                'key' => 'add_paper_submission_requirement',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View Paper Submission Requirement',
                'key' => 'view_paper_submission_requirement',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Delete Paper Submission Requirement',
                'key' => 'delete_paper_submission_requirement',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Delete Paper File Type',
                'key' => 'delete_paper_file_type',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Delete Contributor Role',
                'key' => 'delete_contributor_rule',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Assign User Permission',
                'key' => 'assign_user_permission',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Assign To Review',
                'key' => 'assign_to_review',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'View Assign Paper',
                'key' => 'view_assign_paper',
                'user_level' => User::REVIEWER,
            ],
            [
                'name' => 'View Review Type',
                'key' => 'view_review_type',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Add Review Type',
                'key' => 'add_review_type',
                'user_level' => User::ADMIN,
            ],
            [
                'name' => 'Delete Review Type',
                'key' => 'delete_review_type',
                'user_level' => User::ADMIN,
            ],
            
            
            
        ];
        foreach ($roles as $value) {
            Role::updateOrCreate(
                ['key' => $value['key']],
                [
                    'name' => $value['name'],
                    'user_level' => $value['user_level'],
                ]
            );
        }
    }
}
