<?php

namespace App\Providers;

/*use App\interfaces\{IBaseRepository, IBaseService};
use App\Repositories\BaseRepository;
use App\Services\BaseService;*/
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /*$this->app->singleton(IBaseService::class, BaseService::class);
        $this->app->singleton(IBaseRepository::class, BaseRepository::class);*/
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        if ($this->app->environment('local'))
        {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
