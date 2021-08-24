<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Banner, Footers, Image_policy, Setting};
class ViewSiteProviderService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.index.master.layout', function ($view) {
            //pass the data to the view
            $view
                ->with('setting', Setting::where('state', '1')->first())
                ->with('image_policy', Image_policy::all())
                ->with('banners', Banner::all())
                ->with('footer', Footers::where('state', '1')->first())
                ->with('footer_2', Footers::where('state', '2')->first())
                ->with('footer_3', Footers::where('state', '3')->first());
        });
    }
}
