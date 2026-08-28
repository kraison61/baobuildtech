<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\QuoteRequestController;
use App\Http\Controllers\Admin\PortfolioImageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceItemController;
use App\Http\Controllers\Admin\ServicePriceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkImageController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function (): void {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('service-categories', ServiceCategoryController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('service-items', ServiceItemController::class)->except(['show']);
    Route::resource('service-prices', ServicePriceController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('portfolios', PortfolioController::class)->except(['show']);
    Route::post('portfolios/{portfolio}/images', [PortfolioImageController::class, 'store'])
        ->name('portfolios.images.store');
    Route::delete('portfolio-images/{portfolioImage}', [PortfolioImageController::class, 'destroy'])
        ->name('portfolio-images.destroy');
    Route::resource('work-images', WorkImageController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::resource('posts', PostController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('quote-requests', QuoteRequestController::class)->except(['show']);
});
