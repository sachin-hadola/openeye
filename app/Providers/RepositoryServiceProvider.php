<?php
namespace App\Providers;

use App\Repositories\Contracts\QuestionRepositoryInterface;
use App\Repositories\Eloquent\QuestionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
    }
}