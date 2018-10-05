<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiuController extends Controller
{
    public function miuGet()
    {

    }

    public function miuPost(Request $request)
    {
        header('event_info : xxx');
    }
}
