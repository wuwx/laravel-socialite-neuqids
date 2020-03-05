<?php
namespace Wuwx\LaravelSocialiteNeuqids;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use phpCAS;

class NeuqidsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Socialite::extend('neuqids', function() {
            return new NeuqidsProvider();
        });
    }

    public function register()
    {
        //
    }
}
