<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    // index
    public function index() {
        // get logs paginate by 15 item per page
        $logs = ParkingLog::select('*')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        // return view
        return view('pages.auth.logs', [
            'logs' => $logs
        ]);
    }


}
