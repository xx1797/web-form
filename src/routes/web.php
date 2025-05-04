<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// トップページ（入力フォーム）
Route::get('/', [ContactController::class, 'form'])->name('contact.form');

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// 戻って修正
Route::post('/form', [ContactController::class, 'back'])->name('contact.back');

// 完了（送信）
Route::post('/thanks', [ContactController::class, 'send'])->name('contact.send');

// サンクスページ
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 登録ページ
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ログインページ
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 管理画面（認証ミドルウェアを適用予定）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/detail/{id}', [AdminController::class, 'detail'])->name('admin.detail');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/{contact}', [AdminController::class, 'show'])->name('admin.show');
});