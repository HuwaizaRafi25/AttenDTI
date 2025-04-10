<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadNotifications = Notification::where('receiver', Auth::id())
                    ->where('is_read', operator: false)
                    ->get();

                $allNotifications = Notification::where('receiver', Auth::id())->orderBy('created_at','DESC')->get();

                $view->with('unreadNotifications', $unreadNotifications);
                $view->with('allNotifications', $allNotifications);
            }
            $appSettings = AppSetting::first();
            if (!$appSettings) {
                $appSettings = new AppSetting;
                $appSettings->app_name = 'AttenDTI';
                $appSettings->app_logo = 'logo.png';
                $appSettings->late_time = '08:00:00';
                $appSettings->save();
            }
            $view->with('appName', $appSettings->app_name);
            $view->with('appLogo', $appSettings->app_logo);
            $view->with('lateTime', $appSettings->late_time);
        });
    }
}
