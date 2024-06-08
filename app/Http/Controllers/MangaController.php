<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoremangaRequest;
use App\Http\Requests\UpdatemangaRequest;
use App\Models\manga;
use Inertia\Inertia;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()	
    {	
	
        $mangas = Manga::get();	
	
        return Inertia::render('Mangas/Index', [	
            'mangas' => $mangas,	
        ]);	
    }	

    /**
     * Show the form for creating a new resource.
     */
    public function create()		
    {		
        return Inertia::render('Mangas/Create');		
    }		

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremangaRequest $request)
    {
        Manga::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    
        return to_route('manga.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(manga $manga)
    {	
        return Inertia::render('Mangas/Show', [	
          'manga' => $manga,	
        ]);	
    }	

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(manga $manga)
    {
        return Inertia::render('Mangas/Edit', [
            'manga' => $manga,
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemangaRequest $request, manga $manga)
    {
        {
            $manga->title = $request->title;
            $manga->body = $request->body;
            $manga->save();
    
            return to_route('manga.index')->with([
               'message' => '登録しました。',
               'status' => 'sucess',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(manga $manga)
    {
        {	
            $manga->delete();	
        
            return to_route('manga.index')->with([	
               'message' => '削除しました。',	
               'status' => damger,	
            ]);	
        }	
    }
}
