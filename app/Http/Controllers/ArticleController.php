<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(Request $request) {
        $article = Article::create($request->all());

        return response([
            'article' => $article
        ], 200);
    }
}
