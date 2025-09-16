<style>
    .header {
        background: #007bff;
        color: #fff;
        padding: 16px 0;
        text-align: center;
        font-size: 22px;
        letter-spacing: 2px;
    }

    .footer {
        background: #f1f1f1;
        color: #888;
        text-align: center;
        padding: 12px 0;
        font-size: 15px;
        margin-top: 40px;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f7f7f7;
    }

    .news-edit-container {
        max-width: 500px;
        margin: 40px auto;
        background: #fff;
        padding: 32px 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .news-edit-container h1 {
        text-align: center;
        margin-bottom: 24px;
        color: #333;
    }

    .news-edit-container label {
        display: block;
        margin-bottom: 6px;
        color: #555;
        font-weight: bold;
    }

    .news-edit-container input,
    .news-edit-container textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 18px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background: #fafafa;
    }

    .news-edit-container button {
        width: 100%;
        padding: 10px;
        background: #ffc107;
        color: #333;
        border: none;
        border-radius: 4px;
        font-size: 18px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .news-edit-container button:hover {
        background: #e0a800;
    }
</style>
{{-- 頁首 --}}
<div class="header">新聞系統</div>

{{-- 編輯新聞表單 --}}
<div class="news-edit-container">
    <h1>編輯新聞</h1>
    <form method="POST" action="/news/{{ $news->id }}">
        @csrf {{-- Laravel CSRF 防護 --}}
        @method('PUT') {{-- 指定 HTTP 方法為 PUT --}}
        <div>
            <label for="title">標題</label>
            <input type="text" id="title" name="title" value="{{ $news->title }}" required>
        </div>
        <div>
            <label for="content">新聞內容</label>
            <textarea id="content" name="content" rows="5" required>{{ $news->content }}</textarea>
        </div>
        <div>
            <label for="author">作者</label>
            <input type="text" id="author" name="author" value="{{ $news->author }}" required>
        </div>
        <button type="submit">更新</button>
    </form>
    {{-- 返回新聞列表按鈕 --}}
    <div style="text-align:center;margin-top:18px;">
        <a href="/news" style="color:#007bff;text-decoration:underline;">返回列表</a>
    </div>
</div>

{{-- 頁尾 --}}
<div class="footer">&copy; 2025 新聞系統</div>
