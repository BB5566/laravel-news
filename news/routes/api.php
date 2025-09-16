<?php

use App\Models\News;

Route::get('news', function () {
    return News::orderBy('created_at', 'desc')->get();
});

Route::get('news/{news}', function (News $news) {
    return $news;
});
