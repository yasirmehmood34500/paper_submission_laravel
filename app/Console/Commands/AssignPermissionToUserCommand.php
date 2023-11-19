<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Repositories\LoginRepository;
use Illuminate\Console\Command;

class AssignPermissionToUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:permission-to-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNot('user_level', 1)->get();
        foreach ($users as $user) {
            LoginRepository::assign_permission_to_user($user, (int) $user->user_level);
        }
    }
}
