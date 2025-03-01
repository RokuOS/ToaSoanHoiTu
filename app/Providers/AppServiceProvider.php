<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ChuyenMuc;
use App\Models\QuangCao;
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
            $chuyenmuc = ChuyenMuc::with('loaiTin')->get();
            $view->with('chuyenmuc', $chuyenmuc);
            $quangcaos = QuangCao::where('TrangThai', 'Đang Quảng Cáo')->orderByDesc('NgayQC')->get();
            $view->with('quangcaos', $quangcaos);
        });
    }
}
