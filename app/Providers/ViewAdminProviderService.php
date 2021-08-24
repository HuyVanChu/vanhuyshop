<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{CommentBlog, Customers, Comment_Product};
class ViewAdminProviderService extends ServiceProvider
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
        view()->composer('backend.master.master', function ($view) {
            $total_order = Customers::where('state', 0)->count();
            $total_cmt_blog = CommentBlog::where('state', 0)->count();
            $total_cmt_product = Comment_Product::where('state', 0)->count();
            $total_notif = ($total_order + $total_cmt_blog + $total_cmt_product);
            //pass the data to the view
            $view
                ->with('total_order', $total_order)
                ->with('total_cmt_blog', $total_cmt_blog)
                ->with('total_cmt_product', $total_cmt_product)
                ->with('total_notif', $total_notif);
        });
    }
}
