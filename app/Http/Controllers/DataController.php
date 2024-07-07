<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DataController extends Controller
{
    /**
     * リソースを表示する.
     */
    public function index()
    {
        // データベース名を取得
        $databaseName = DB::getDatabaseName();

        // データベースからテーブル一覧を取得
        $tables = DB::select('SHOW TABLES');

        // カラム名を動的に取得
        $columnName = 'Tables_in_' . $databaseName;

        // テーブル名を整形
        $formattedTables = collect($tables)->map(function ($table) use ($columnName) {
            return [
                'value' => $table->$columnName,
                'label' => $table->$columnName,
            ];
        });

        $formattedTables->prepend(['value' => '', 'label' => '']);
        $formattedTableArray = $formattedTables->toArray();

        return Inertia::render('Data/Index', [
            'tableList' => $formattedTableArray,
        ]);
    }

    /**
     * Json形式でデータをダウンロードする.
     */
    public function downloadJson(Request $request)
    {

        // データベースからデータを取得
        $data = DB::table($request->table)->get();

        // JSONファイルを作成
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // レスポンスとしてJSONファイルを返す
        return response($jsonData, 200)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="'. $request->table. '.json"');
    }
}
