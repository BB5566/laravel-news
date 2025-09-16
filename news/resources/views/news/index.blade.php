{{-- 頁面樣式設定 --}}
<style>
    /* 頁首樣式 */
    .header {
        background: #007bff;
        color: #fff;
        padding: 16px 0;
        text-align: center;
        font-size: 22px;
        letter-spacing: 2px;
    }

    /* 頁尾樣式 */
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

    .news-list-container {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        padding: 32px 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .news-list-container h1 {
        text-align: center;
        margin-bottom: 24px;
        color: #333;
    }

    .news-item {
        border-bottom: 1px solid #eee;
        padding: 18px 0;
    }

    .news-item:last-child {
        border-bottom: none;
    }

    .news-title {
        font-size: 22px;
        color: #007bff;
        margin-bottom: 6px;
        text-decoration: none;
    }

    .news-meta {
        color: #888;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .news-content {
        color: #333;
        font-size: 16px;
    }

    .add-btn {
        display: block;
        margin: 0 auto 24px auto;
        padding: 8px 18px;
        background: #28a745;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        width: 120px;
    }

    .add-btn:hover {
        background: #218838;
    }
</style>
{{-- 頁首 --}}
<div class="header">新聞系統</div>

{{-- 主要內容區塊 --}}
<div class="news-list-container">
    <h1>新聞列表</h1>

    {{-- 顯示操作成功訊息 --}}
    @if (session('success'))
        <div style="color:green;text-align:center;margin-bottom:16px;">{{ session('success') }}</div>
    @endif

    {{-- 新增新聞按鈕 --}}
    <a href="/news/create" class="add-btn">新增新聞</a>

    {{-- 迴圈顯示所有新聞 --}}
    @foreach ($news as $item)
        <div class="news-item">
            {{-- 點擊標題可進入單篇新聞 --}}
            <a href="/news/{{ $item->id }}" class="news-title">{{ $item->title }}</a>
            <div class="news-meta">作者：{{ $item->author }}｜建立時間：{{ $item->created_at->format('Y-m-d H:i') }}</div>
            {{-- 只顯示前80字內容 --}}
            <div class="news-content">{{ Str::limit($item->content, 80) }}</div>
            <div style="margin-top:8px;">
                {{-- 編輯按鈕 --}}
                <a href="/news/{{ $item->id }}/edit" style="color:#ffc107;margin-right:12px;">編輯</a>
                {{-- 刪除按鈕（用表單送出） --}}
                <form method="POST" action="/news/{{ $item->id }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color:#dc3545;background:none;border:none;cursor:pointer;">刪除</button>
                </form>
            </div>
        </div>
    @endforeach

    {{-- 如果沒有新聞，顯示提示文字 --}}
    @if ($news->isEmpty())
        <p style="text-align:center;color:#888;">目前沒有新聞。</p>
    @endif
</div>

{{-- 頁尾 --}}
<div class="footer">&copy; 2025 新聞系統</div>
