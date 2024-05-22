<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // データの挿入
        DB::table('educations')->insert([
            'title' => 'Laravelとは',
            'body' => 'Laravelは、PHPで書かれたオープンソースのWebアプリケーションフレームワークです。Taylor Otwellによって2011年に作成され、主にWebアプリケーションの開発を効率的かつシンプルにすることを目的としています。Laravelは、簡潔で読みやすい構文を持ち、開発者が一般的なWeb開発タスクを容易に実行できるように設計されています。',
            'body_html' => 'Laravelは、PHPで書かれたオープンソースのWebアプリケーションフレームワークです。Taylor Otwellによって2011年に作成され、主にWebアプリケーションの開発を効率的かつシンプルにすることを目的としています。Laravelは、簡潔で読みやすい構文を持ち、開発者が一般的なWeb開発タスクを容易に実行できるように設計されています。',
            'order' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // データの挿入
        DB::table('educations')->insert([
            'title' => '前提条件',
            'body' => 'インストール済 Windows WSL2 VSCode',
            'body_html' => 'インストール済 Windows WSL2 VSCode',
            'order' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
