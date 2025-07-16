<?php

namespace App\Providers;

use App\Models\Pengaturans;
use App\Models\Testimoni;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate as FacadesGate;
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
        $pengaturan = Pengaturans::first();
        $testimoni = Testimoni::all();
        View::share('pengaturan', $pengaturan);
        View::share('testimoni', $testimoni);
    }
}
