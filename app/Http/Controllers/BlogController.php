<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;
use App\Models\blog;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::get();

        return Inertia::render('Blogs/Index', [
            'blogs' => $blogs,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Blogs/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogRequest $request)
    {

        Blog::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('blog.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        return Inertia::render('Blogs/Show', [
            'blog' => $blog,
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        return Inertia::render('Blogs/Edit', [
            'blog' => $blog,
          ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateblogRequest $request, blog $blog)
    {
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save();

        return to_route('blog.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {
        $blog->delete();

        return to_route('blog.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);

    }
}
