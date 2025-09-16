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

    .news-show-container {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        padding: 32px 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .news-title {
        font-size: 28px;
        color: #007bff;
        margin-bottom: 12px;
    }

    .news-meta {
        color: #888;
        font-size: 15px;
        margin-bottom: 18px;
    }

    .news-content {
        color: #333;
        font-size: 18px;
        margin-bottom: 24px;
    }

    .back-btn {
        display: block;
        margin: 0 auto;
        padding: 8px 18px;
        background: #6c757d;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        width: 120px;
    }

    .back-btn:hover {
        background: #343a40;
    }
</style>
{{-- 頁首 --}}
<div class="header">新聞系統</div>

{{-- 單篇新聞內容 --}}
<div class="news-show-container">
    {{-- 顯示操作成功訊息 --}}
    @if (session('success'))
        <div style="color:green;text-align:center;margin-bottom:16px;">{{ session('success') }}</div>
    @endif
    <div class="news-title">{{ $news->title }}</div>
    <div class="news-meta">作者：{{ $news->author }}｜建立時間：{{ $news->created_at->format('Y-m-d H:i') }}</div>
    <div class="news-content">{{ $news->content }}</div>
    <div style="margin-bottom:16px;text-align:center;">
        {{-- 編輯按鈕 --}}
        <a href="/news/{{ $news->id }}/edit" style="color:#ffc107;margin-right:12px;">編輯</a>
        {{-- 刪除按鈕（用表單送出） --}}
        <form method="POST" action="/news/{{ $news->id }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="color:#dc3545;background:none;border:none;cursor:pointer;">刪除</button>
        </form>
    </div>
    {{-- 返回新聞列表按鈕 --}}
    <a href="/news" class="back-btn">返回列表</a>
</div>

{{-- 頁尾 --}}
<div class="footer">&copy; 2025 新聞系統</div>
