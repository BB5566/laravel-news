<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

// 首頁顯示新聞列表
Route::get('/', [NewsController::class, 'index']);

// 自動產生新聞 CRUD 路由（包含 index, show, create, store, edit, update, destroy）
Route::resource('news', NewsController::class);
