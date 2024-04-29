<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Contactus;
use App\Models\Locations;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

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

    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);

        $debug = false;
        if (in_array(request()->getHttpHost(), ['bosnia-gulf-realstate.test'])) {
            $debug = true;
        }

        $this->app['request']->server->set('HTTPS', $debug ? false : true);
        view()->composer('*', function ($view) {
        });

        view()->composer('admin.*', function ($view) {
            $view->with([
                'inbox' => Contactus::where('is_read', 0)->count(),
                'language' => app()->getLocale(),
                'current_locale' => app()->getLocale(),
                'available_locales' => config('laravellocalization.supportedLocales'),
                'settings' => Settings::where('id', 1)->first()
            ]);
        });

        view()->composer(['lasould.*'], function ($view) {
            $view->with([
                'settings' => Settings::where('id', 1)->first(),
            ]);
        });
    }
}
