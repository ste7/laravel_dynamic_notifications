<?php

namespace App\Providers;

use App\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Notifications\DynamicNotifications;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $notifiable = Notifiable::all();
//
//        foreach ($notifiable as $item) {
//            $item->model::creating(function () use($item) {
//                auth()->user()->notify(new DynamicNotifications(auth()->user(), $item->model, $item->message));
//            });
//        }

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
