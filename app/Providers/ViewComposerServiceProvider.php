<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Carousel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Cart;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        View::composer('site.partials.nav', function ($view) {
            $view->with('categories', Category::where('menu', 1)->orderByRaw('-name ASC')->get()->nest());
        });
        View::composer('site.partials.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
        View::composer('site.partials.header', function ($view) {
            $view->with('carousels', Carousel::where('status', 1)->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
