<?php

namespace App\Providers;

use App\Interfaces\AssignReviewInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\LoginInterface;
use App\Repositories\UserRepository;
use App\Repositories\LoginRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\SubmissionFileInterface;
use App\Interfaces\PaperSubmissionInterface;
use App\Interfaces\AuthorContributorInterface;
use App\Repositories\SubmissionFileRepository;
use App\Interfaces\SubmissionFileTypeInterface;
use App\Repositories\PaperSubmissionRepository;
use App\Repositories\AuthorContributorRepository;
use App\Interfaces\AuthorContributorRuleInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\RoleUserInterface;
use App\Interfaces\SubmissionRequirementInterface;
use App\Models\SubmissionRequirement;
use App\Repositories\AssignReviewRepository;
use App\Repositories\SubmissionFileTypeRepository;
use App\Repositories\AuthorContributorRuleRepository;
use App\Repositories\RoleRepository;
use App\Repositories\RoleUserRepository;
use App\Repositories\SubmissionRequirementRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $this->app->bind(LoginInterface::class, LoginRepository::class);
        $this->app->bind(AuthorContributorInterface::class, AuthorContributorRepository::class);
        $this->app->bind(AuthorContributorRuleInterface::class, AuthorContributorRuleRepository::class);
        $this->app->bind(PaperSubmissionInterface::class, PaperSubmissionRepository::class);
        $this->app->bind(SubmissionFileInterface::class, SubmissionFileRepository::class);
        $this->app->bind(SubmissionFileTypeInterface::class, SubmissionFileTypeRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(SubmissionRequirementInterface::class, SubmissionRequirementRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(RoleUserInterface::class, RoleUserRepository::class);
        $this->app->bind(AssignReviewInterface::class, AssignReviewRepository::class);
    }
}
