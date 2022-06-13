<?php

namespace App\Providers;

use App\Services\Interfaces\SaleServiceInterface;
use App\Services\Interfaces\ShippingCostServiceInterface;
use App\Services\SaleService;
use App\Services\ShippingCostService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaleServiceInterface::class, SaleService::class);
        $this->app->bind(ShippingCostServiceInterface::class, ShippingCostService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
