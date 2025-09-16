<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    // 顯示新增新聞表單
    public function create()
    {
        return view('news.create');
    }

    // 儲存新聞資料
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        News::create($validated);

        return redirect()->route('news.index')->with('success', '新聞已新增！');
    }

    // 顯示新聞列表
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('news.index', compact('news'));
    }

    // 顯示單篇新聞
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    // 顯示編輯表單
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    // 更新新聞
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);
        $news->update($validated);
        return redirect()->route('news.show', $news)->with('success', '新聞已更新！');
    }

    // 刪除新聞
    public function destroy(News $news)
    {
        $news->delete();
        return redirect('/news')->with('success', '新聞已刪除！');
    }
}
