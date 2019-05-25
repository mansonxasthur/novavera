<?php

namespace App\Providers;

use App\Citizenship;
use App\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $view->with(['pageList' => Page::published()->get()]);
        });

        View::composer('*', function($view) {
            $view->with(['citizenshipList' => Citizenship::where('type', 'citizenship')->get()]);
        });

        View::composer('*', function($view) {
            $view->with(['residencyList' => Citizenship::where('type', 'residency')->get()]);
        });

        View::composer('*', function($view) {
            $view->with(['locale' => App::getLocale()]);
        });
    }
}
