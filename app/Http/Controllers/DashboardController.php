<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use App\Models\ParkingSlot;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public static function getParkingSlots()
    {
        try {
            return response()->json(ParkingSlot::all());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // input queues
    public function inputQueue(Request $request)
    {
        try {
            $status = Storage::put('waiting/waiting.json', json_encode(['queue' => (int) $request->queue]), JSON_PRETTY_PRINT);

            if (!$status) {
                throw new Exception("Failed to update json waiting");
            }

            session()->flash('success', 'Successfully Update Queue');
            return redirect()->back();
        } catch (\Throwable $th) {
            /**
             * log errors
             * redirect back with errors
             */
            Log::error($th->getMessage());
            return redirect()->back()->withErrors("Something Went Wrong, Pls Try Again! Thank You");
        }
    }

    // get months for chart one
    public function getMonthsForChart($year)
    {
        try {
            // get data
            $data = ParkingLog::getMonths($year);

            // return data
            return response()->json($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            /**
             * log errors
             * response 500
             */
            return response(null, 500);
        }
    }

    public function getDataPerMonthPerSlot($slot, $year) {
        try {
            $data = ParkingLog::getDataPerMonthPerSlot($slot, $year);

            return response()->json($data);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
