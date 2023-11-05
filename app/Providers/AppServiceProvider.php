<?php

namespace App\Providers;

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
use App\Repositories\SubmissionFileTypeRepository;
use App\Repositories\AuthorContributorRuleRepository;

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
    }
}
