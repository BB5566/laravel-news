# Laravel 新聞系統學習筆記

本專案是一個簡易的 Laravel 新聞 CRUD 系統，適合初學者練習。以下內容整合所有教學、API、排錯與常見問題，讓你一看就懂！

---

## 功能總覽

- 新聞列表
- 新增新聞
- 編輯新聞
- 刪除新聞
- 單篇新聞顯示
- 提供 API 取得 JSON 資料

---

## 安裝與啟動步驟

1. 安裝套件：
	```bash
	composer install
	```
2. 建立資料表：
	```bash
	php artisan migrate
	```
3. 啟動伺服器：
	```bash
	php artisan serve
	```
4. 預設網址：
	- 首頁/新聞列表：`http://localhost:8000/`
	- 新增新聞：`http://localhost:8000/news/create`
	- 編輯新聞：`http://localhost:8000/news/{id}/edit`
	- 單篇新聞：`http://localhost:8000/news/{id}`
	- API 所有新聞：`http://localhost:8000/api/news`
	- API 單篇新聞：`http://localhost:8000/api/news/1`

---

## 資料表結構

- 標題（title）
- 內容（content）
- 作者（author）
- 建立時間（created_at，自動）

---

## 主要檔案與註解

### 路由設定
`routes/web.php`：網頁功能路由
```php
// 首頁顯示新聞列表
Route::get('/', [NewsController::class, 'index']);
// 自動產生新聞 CRUD 路由
Route::resource('news', NewsController::class);
```

`routes/api.php`：API 路由
```php
use App\Models\News;
Route::get('news', function() {
	 return News::orderBy('created_at', 'desc')->get();
});
Route::get('news/{news}', function(News $news) {
	 return $news;
});
```

### Controller 註解
`app/Http/Controllers/NewsController.php`
- create：顯示新增表單
- store：儲存新聞
- index：顯示列表
- show：顯示單篇
- edit：顯示編輯表單
- update：更新新聞
- destroy：刪除新聞

### Model 設定
`app/Models/News.php`
```php
protected $fillable = ['title', 'content', 'author']; // 批量賦值安全設定
```

### Blade 頁面註解
`resources/views/news/*.blade.php`
- 頁首、頁尾
- 新增/編輯/顯示/列表表單
- @csrf、@method('PUT')
- 返回列表按鈕
- 註解說明每個區塊

---

## API 筆記

1. API 路由請加在 `routes/api.php`，不要加在 `web.php`。
2. API 路由預設無 session/csrf，適合前端或 APP 取用。
3. 若遇到 `/api/news` 404，請檢查：
	- `bootstrap/app.php` 有載入 api 路由：
	  ```php
	  ->withRouting(
			web: __DIR__.'/../routes/web.php',
			api: __DIR__.'/../routes/api.php',
			...
	  )
	  ```
	- 專案根目錄啟動 `php artisan serve`
	- API 路由語法正確

---

## 常見操作

- 新增新聞：填寫表單送出。
- 編輯新聞：進入編輯頁面修改內容。
- 刪除新聞：點擊刪除按鈕。
- 返回列表：各頁面均有返回列表按鈕。
- 取得 JSON：用 API 路由存取。

---

## 常見排錯與解決

- API 路由 404：檢查 `bootstrap/app.php` 是否有載入 api 路由。
- 路由沒生效：確認 artisan serve 執行目錄正確。
- 資料庫連線錯誤：檢查 `.env` 設定。
- MassAssignmentException：Model 要加 `$fillable`。

---

## 學習重點

- 路由與 RESTful 資源控制器
- Blade 模板語法與註解
- 表單送出與 CSRF 防護
- 資料庫 migration 與 Model 設定
- API 路由整合

---

如需進一步優化或加入新功能，歡迎隨時練習與詢問！

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

-   create：顯示新增表單
-   store：儲存新聞
-   index：顯示列表
-   show：顯示單篇
-   edit：顯示編輯表單
-   update：更新新聞
-   destroy：刪除新聞


#### `app/Models/News.php` 資料模型

```php
protected $fillable = ['title', 'content', 'author']; // 批量賦值安全設定
```


#### API 取用 JSON 資料

你可以在 `routes/api.php` 加入以下內容，讓前端或 APP 取得 JSON 資料：

```php
use App\Models\News;

// 取得所有新聞 JSON
Route::get('news', function() {
	return News::orderBy('created_at', 'desc')->get();
});

// 取得單篇新聞 JSON
Route::get('news/{news}', function(News $news) {
	return $news;
});
```

步驟：
1. 編輯 `routes/api.php`，貼上上方程式碼。
2. 確認已啟動 Laravel 伺服器（`php artisan serve`）。
3. 在瀏覽器或前端程式使用：
   - `http://localhost:8000/api/news` 取得所有新聞 JSON
   - `http://localhost:8000/api/news/1` 取得單篇新聞 JSON

注意：
- API 路由請加在 `api.php`，不要加在 `web.php`。
- API 路由預設無 session/csrf，適合前端或 APP 取用。

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
