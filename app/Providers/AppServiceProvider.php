<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\MembershipPackage;
use App\Model\Subject;
use App\Model\District;
use Illuminate\Support\ServiceProvider;
use App\Notification;
use App\SubCategory;
use App\UserAd;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('subjts', Subject::orderBy('title')->where('active', true)->get());

        view()->share('notifications', Notification::latest()->get());
        view()->share('categories', Category::latest()->get());

        view()->share('packages', MembershipPackage::latest()->get());

        view()->share('agriFoodCat', SubCategory::where('cat_id',22)->latest()->get());
        view()->share('petCat', SubCategory::where('cat_id',20)->latest()->get());
        view()->share('agriCat', SubCategory::where('cat_id',21)->latest()->get());
        view()->share('dairyP', SubCategory::where('cat_id',23)->latest()->get());

        view()->share('districts', District::orderBy('name','ASC')->get());
        view()->share('p_cat', Category::where('position','!=',null)->orderBy('position','ASC')->get());
        view()->share('cat', Category::where('position',null)->latest()->get());


    }
}
