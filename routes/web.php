<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CtaClickController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\ServiceItemController;
use App\Http\Controllers\Front\SitemapController;
use App\Models\ServiceItem;
use Illuminate\Support\Facades\Route;

$frontRoutes = function (): void {
    Route::get('/', function () {
        return view('front.home');
    })->name('home');

    Route::get('/services', [ServiceController::class, 'index'])->name('services');

    Route::get('/services/{categorySlug}/{serviceSlug}/{itemSlug}', [ServiceItemController::class, 'show'])
        ->name('services.items.show');

    Route::get('/services/{categorySlug}/{serviceSlug}', [ServiceController::class, 'show'])
        ->name('services.show');

    Route::get('/services/{slug}', [ServiceController::class, 'showLegacy']);

    Route::get('/aluminium-door-window', static function () {
        $item = ServiceItem::query()
            ->where('slug', 'aluminium-door-window')
            ->where('is_published', true)
            ->with('service.category')
            ->firstOrFail();

        return redirect($item->url(), 301);
    })->name('aluminium-door-window');

    Route::view('/works', 'front.placeholder', [
        'titleKey' => 'ui.works_title',
        'headingKey' => 'ui.works_heading',
        'descriptionKey' => 'ui.works_description',
    ])->name('works');

    Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');

    Route::view('/gallery', 'front.placeholder', [
        'titleKey' => 'ui.gallery_title',
        'headingKey' => 'ui.gallery_heading',
        'descriptionKey' => 'ui.gallery_description',
    ])->name('gallery');

    Route::view('/about', 'front.about')->name('about');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
};

// ไทย (default) — ไม่มี prefix
$frontRoutes();

Route::redirect('/aluminium-door-window-installation', '/aluminium-door-window', 301);
Route::permanentRedirect('/articles', '/blog');

// อังกฤษ — prefix /en + name en.*
Route::prefix('en')->name('en.')->group($frontRoutes);

Route::prefix('en')->group(function (): void {
    Route::redirect('/aluminium-door-window-installation', '/en/aluminium-door-window', 301);
    Route::permanentRedirect('/articles', '/en/blog');
});

// Sitemap / robots / CTA — root เท่านั้น
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');
Route::post('/cta-clicks', [CtaClickController::class, 'store'])
    ->middleware('throttle:60,1')
    ->name('cta-clicks.store');
