<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $pushKey = config('broadcasting.connections.pusher.key');
        
        return view('dashboard')->withPushKey($pushKey);
    }
}
