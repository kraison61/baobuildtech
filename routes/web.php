<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\ServiceItemController;
use App\Models\ServiceItem;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home');
})->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::get('/services/{categorySlug}/{serviceSlug}/{itemSlug}', [ServiceItemController::class, 'show'])
    ->name('services.items.show');

Route::get('/services/{categorySlug}/{serviceSlug}', [ServiceController::class, 'show'])
    ->name('services.show');

Route::get('/services/{slug}', [ServiceController::class, 'showLegacy']);

Route::redirect('/aluminium-door-window-installation', '/aluminium-door-window', 301);

Route::get('/aluminium-door-window', static function () {
    $item = ServiceItem::query()
        ->where('slug', 'aluminium-door-window')
        ->where('is_published', true)
        ->with('service.category')
        ->firstOrFail();

    return redirect($item->url(), 301);
})->name('aluminium-door-window');

Route::view('/works', 'front.placeholder', [
    'title' => 'ผลงาน',
    'heading' => 'ผลงาน',
    'description' => 'รวมโครงการที่เราเคยรับผิดชอบ พร้อมรายละเอียดขอบเขตงานและหลักฐานหน้างาน',
])->name('works');

Route::view('/articles', 'front.placeholder', [
    'title' => 'บทความ',
    'heading' => 'บทความ',
    'description' => 'บทความความรู้เรื่องกำแพงกันดิน ฐานราก งานโยธา และระบบในโครงการ',
])->name('articles');

Route::view('/gallery', 'front.placeholder', [
    'title' => 'คลังภาพผลงาน',
    'heading' => 'คลังภาพผลงาน',
    'description' => 'คลังภาพจากหน้างานจริง ทั้งก่อนระหว่างและหลังก่อสร้าง',
])->name('gallery');

Route::view('/about', 'front.about')->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
