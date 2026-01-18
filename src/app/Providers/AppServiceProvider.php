<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Event;

use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Kakao\KakaoProvider;
use SocialiteProviders\Naver\Provider as NaverProvider;

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
    public function boot(): void
    {
        //
        Event::listen(SocialiteWasCalled::class, function (SocialiteWasCalled $event) {
            $event->extendSocialite('kakao', KakaoProvider::class);
            $event->extendSocialite('naver', NaverProvider::class);
        });
    }
}
