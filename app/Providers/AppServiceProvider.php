<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;


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
        View::composer(['admin.*'], function($view) {
        $bitisZamani = now()->addMinutes(10);
        $istatistikler = Cache::remember('istatistikler', $bitisZamani, function () {
            return [
                'bekleyen_siparis' => Order::where('status', 'Siparişiniz alındı')->count(),
                'tamamlanan_siparis' => Order::where('status', 'Sipariş tamamlandı')->count(),
                'toplam_urun' => Product::count(),
                'toplam_kategori' => Category::count(),
                'toplam_kullanici' => User::count()
            ];
        });

        $view->with('istatistikler', $istatistikler);
    });
    }
}
