<?php

namespace App\Providers;

use App\Repositories\Classes\ClassEloquent;
use App\Repositories\Classes\ClassRepository;
use App\Repositories\Sections\SectionEloquent;
use App\Repositories\Sections\SectionRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->singleton(ClassRepository::class, ClassEloquent::class);
        $this->app->singleton(SectionRepository::class, SectionEloquent::class);
    }
}
