<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($log) {
                $log->username = $log->user ? $log->user->name : 'Unknown';
                return $log;
            });

        return view('logs.index', compact('logs'));
    }
}
