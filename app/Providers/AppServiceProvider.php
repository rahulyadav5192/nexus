<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\ContactDetails;

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
        //
        Schema::defaultstringlength(191);
        Paginator::useBootstrap();
        
        // Share contact_details globally to all frontend views
        View::composer('frontend.*', function ($view) {
            $contact_details = ContactDetails::find(1);
            $view->with('contact_details', $contact_details);
        });
    }
}
