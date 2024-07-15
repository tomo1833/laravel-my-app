<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storebroadcast_periodRequest;
use App\Http\Requests\Updatebroadcast_periodRequest;
use App\Models\broadcast_period;

use Inertia\Inertia;


class BroadcastPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $broadcast_periods = Broadcast_period::get();

        return Inertia::render('Broadcast_periods/Index', [
            'broadcast_periods' => $broadcast_periods,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Broadcast_periods/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storebroadcast_periodRequest $request)
    {
        Broadcast_period::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return to_route('broadcast_period.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(broadcast_period $broadcast_period)
    {
        return Inertia::render('Broadcast_periods/Show', [
            'broadcast_period' => $broadcast_period,
         ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(broadcast_period $broadcast_period)
    {
        return Inertia::render('Broadcast_periods/Edit', [
            'broadcast_period' => $broadcast_period,
         ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatebroadcast_periodRequest $request, broadcast_period $broadcast_period)
    {
        $broadcast_period->name = $request->name;
        $broadcast_period->order = $request->order;
        $broadcast_period->save();

        return to_route('broadcast_period.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(broadcast_period $broadcast_period)
    {
        $broadcast_period->delete();

        return to_route('broadcast_period.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);

    }
}
