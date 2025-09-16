# Laravel 新聞系統教學

本專案是一個簡易的 Laravel 新聞 CRUD 系統，適合初學者練習。

## 功能

-   新聞列表
-   新增新聞
-   編輯新聞
-   刪除新聞
-   單篇新聞顯示

## 操作步驟

### 1. 安裝與啟動

```bash
composer install
php artisan migrate
php artisan serve
```

### 2. 主要網址

-   首頁/新聞列表：`http://localhost:8000/`
-   新增新聞：`http://localhost:8000/news/create`
-   編輯新聞：`http://localhost:8000/news/{id}/edit`
-   單篇新聞：`http://localhost:8000/news/{id}`

### 3. 新聞資料表結構

-   標題（title）
-   內容（content）
-   作者（author）
-   建立時間（created_at，自動）

### 4. 主要檔案說明與註解

#### `routes/web.php` 路由設定
```php
// 首頁顯示新聞列表
Route::get('/', [NewsController::class, 'index']);

// 自動產生新聞 CRUD 路由（包含 index, show, create, store, edit, update, destroy）
Route::resource('news', NewsController::class);
```

#### `resources/views/news/index.blade.php` 新聞列表頁
```blade
{{-- 頁面樣式設定 --}}
{{-- 頁首 --}}
{{-- 主要內容區塊 --}}
{{-- 顯示操作成功訊息 --}}
{{-- 新增新聞按鈕 --}}
{{-- 迴圈顯示所有新聞 --}}
{{-- 點擊標題可進入單篇新聞 --}}
{{-- 只顯示前80字內容 --}}
{{-- 編輯按鈕 --}}
{{-- 刪除按鈕（用表單送出） --}}
{{-- 如果沒有新聞，顯示提示文字 --}}
{{-- 頁尾 --}}
```

#### `resources/views/news/create.blade.php` 新增新聞頁
```blade
{{-- 頁首 --}}
{{-- 新增新聞表單 --}}
@csrf {{-- Laravel CSRF 防護 --}}
{{-- 返回新聞列表按鈕 --}}
{{-- 頁尾 --}}
```

#### `resources/views/news/edit.blade.php` 編輯新聞頁
```blade
{{-- 頁首 --}}
{{-- 編輯新聞表單 --}}
@csrf {{-- Laravel CSRF 防護 --}}
@method('PUT') {{-- 指定 HTTP 方法為 PUT --}}
{{-- 返回新聞列表按鈕 --}}
{{-- 頁尾 --}}
```

#### `resources/views/news/show.blade.php` 單篇新聞頁
```blade
{{-- 頁首 --}}
{{-- 單篇新聞內容 --}}
{{-- 顯示操作成功訊息 --}}
{{-- 編輯按鈕 --}}
{{-- 刪除按鈕（用表單送出） --}}
{{-- 返回新聞列表按鈕 --}}
{{-- 頁尾 --}}
```

#### `app/Http/Controllers/NewsController.php` 控制器
每個方法都已加中文註解，說明用途：
- create：顯示新增表單
- store：儲存新聞
- index：顯示列表
- show：顯示單篇
- edit：顯示編輯表單
- update：更新新聞
- destroy：刪除新聞

#### `app/Models/News.php` 資料模型
```php
protected $fillable = ['title', 'content', 'author']; // 批量賦值安全設定
```

### 5. 常見操作

-   新增新聞：填寫表單送出。
-   編輯新聞：進入編輯頁面修改內容。
-   刪除新聞：點擊刪除按鈕。
-   返回列表：各頁面均有返回列表按鈕。

### 6. 學習重點

-   路由與 RESTful 資源控制器
-   Blade 模板語法與註解
-   表單送出與 CSRF 防護
-   資料庫 migration 與 Model 設定

---

如需進一步優化或加入新功能，歡迎隨時練習與詢問！
