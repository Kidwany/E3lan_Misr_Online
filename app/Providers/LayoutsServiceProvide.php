<?php

namespace App\Providers;

use App\Http\ViewComposers\LayoutsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class LayoutsServiceProvide extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'website.welcome',
                'website.about',
                'website.contact',
                'website.blog',
                'website.blogDetails',
                'website.services',
                'website.serviceDetails',
                'website.client',
                'website.offers',
                'website.album',
                'website.albumDetails',
                'website.video',
                'website.gallery',
                'website.team',
                'website.portfolio',
                'website.project',
                'website.buildCamp',
                'website.search',
                'website.services_details',
                'website.requestedItems',
                'website.myCampaigns',
                'website.login',
                'website.myCampaigns_details',
                'website.product',
                'website.campaignDate',
                'website.graft_save',
            ],
            LayoutsComposer::class
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
