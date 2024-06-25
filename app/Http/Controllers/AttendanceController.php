<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use App\Models\attendance;
use App\Models\Event;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 年月をリクエストから取得または現在の年月を使用
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        // 月の初日と最終日を設定
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        // 指定月のデータを取得
        $attendances = Attendance::where('user_id', '=', $request->user()->id)
            ->where('date', '>=', $startOfMonth)
            ->where('date', '<=', $endOfMonth)
            ->get()
            ->keyBy('date');


        // 月の全日をループしてデータ配列を作成
        $daysInMonth = [];
        for ($date = clone $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $daysInMonth[$date->toDateString()] = $attendances->get($date->toDateString(), null);
        }

        // Inertia.jsにデータを渡す
        return Inertia::render('Attendances/Index', [
            'attendances' => $daysInMonth,
            'year' => $year,
            'month' => $month
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Attendances/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreattendanceRequest $request)
    {
        Attendance::create([
            'user_id' => $request->user()->id,
            'date' => $request->date,
            'check_in' => date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->check_in)),
            'check_out' => date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->check_out)),
            'rest_period' => $request->rest_period,
            'memo' => $request->memo,
        ]);

        Event::create([
            'title' => '仕事',
            'start' => date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->check_in)),
            'end' => date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->check_out)),
            'is_public' => false,
            'user_id' => $request->user()->id,
        ]);

        return to_route('attendance.index')->with([
            'message' => '登録しました。',
            'status' => 'create',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attendance $attendance)
    {
        return Inertia::render('Attendances/Edit', [
            'attendance' => $attendance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateattendanceRequest $request, attendance $attendance)
    {
        $attendance->check_in = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->check_in));
        $attendance->check_out = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->check_out));
        $attendance->rest_period = $request->rest_period;
        $attendance->memo = $request->memo;
        $attendance->save();

        return to_route('attendance.index')->with([
            'message' => '更新しました。',
            'status' => 'create',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attendance $attendance)
    {
        $attendance->delete();
        return to_route('attendance.index')->with([
            'message' => '削除しました。',
            'status' => 'delete',
        ]);

    }
}
