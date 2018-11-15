<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request) {
        $tag = Tag::create($request->all());

        return response([
            'tag' => $tag
        ], 200);
    }
}
