<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard');
// });
})->name('home');

Route::middleware('auth')->group(function () {
    // 마이페이지 (새로 추가)
    Route::get('/mypage', function () {
        return view('mypage');
    })->name('mypage');

    // 프로필 관리 (Breeze 기본)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 소셜 로그인 라우트
Route::get('auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
// 소셜 로그인 (Breeze auth.php require 보다 위에 있어야 함)
// Route::get('auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
// Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// 로그인, 회원가입 등은 Breeze auth.php 에서 자동으로 guest 미들웨어가 적용됩니다.
require __DIR__.'/auth.php';
