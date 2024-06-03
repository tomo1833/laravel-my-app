<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorebookRequest;
use App\Http\Requests\UpdatebookRequest;
use App\Models\book;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::get();

        return Inertia::render('Books/Index', [
            'books' => $books,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Books/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebookRequest $request)
    {
        Book::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('book.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {
        return Inertia::render('Books/Show', [
            'book' => $book,
          ]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book,
          ]);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebookRequest $request, book $book)
    {
        $book->title = $request->title;	
        $book->body = $request->body;	
        $book->save();	
	
        return to_route('book.index')->with([	
           'message' => '登録しました。',	
           'status' => 'sucess',	
        ]);	

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book)
    {
        return to_route('book.index')->with([	
            'message' => '削除しました。',	
            'status' => 'damger',	
         ]);	
 
    }
}
