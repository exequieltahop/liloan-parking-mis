<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use App\Models\ParkingSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SensorDataController extends Controller
{
    public function logData($slot_no, $status)
    {
        try {
            // update parking status
            $update_status = ParkingSlot::where('slot_no', $slot_no)
                ->update([
                    'status' => $status
                ]);

            // log parking
            $create_status = ParkingLog::insert([
                'slot_no' => $slot_no,
                'type' => $status == 'occupied' ? 'in' : 'out',
                'created_at' => Carbon::now('Asia/Manila')->format('Y-m-d h:i:s')
            ]);

            return response(null, 200); // response 200
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
