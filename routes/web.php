<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\ServiceItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home');
})->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::redirect('/services/aluminium-works', '/services/aluminum-works', 301);
Route::redirect('/aluminium-door-window-installation', '/aluminium-door-window', 301);
Route::redirect('/services/aluminum-works/aluminium-door-window', '/aluminium-door-window', 301);
Route::get('/aluminium-door-window', [ServiceItemController::class, 'show'])
    ->defaults('serviceSlug', 'aluminum-works')
    ->defaults('itemSlug', 'aluminium-door-window')
    ->name('aluminium-door-window');
Route::get('/services/{serviceSlug}/{itemSlug}', [ServiceItemController::class, 'show'])->name('services.items.show');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
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
