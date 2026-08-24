<?php

use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\ServiceItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home');
})->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services');
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

Route::view('/about', 'front.placeholder', [
    'title' => 'เกี่ยวกับเรา',
    'heading' => 'เกี่ยวกับเรา',
    'description' => 'เรื่องราวของทีมช่าง ธีรพงษ์การช่าง และแนวทางการทำงานที่ตรวจสอบได้ทุกชั้นงาน',
])->name('about');
