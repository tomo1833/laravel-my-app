<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FlowController extends Controller
{
    public function index()
    {
        return Inertia::render('Flow/Index', []);
    }

}
