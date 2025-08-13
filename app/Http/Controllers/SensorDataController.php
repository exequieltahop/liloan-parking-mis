<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use App\Models\ParkingSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

    public function getData(Request $request)
    {
        try {

            $response = '';

            $results = DB::table('parking_slots')
                ->select(DB::raw('COUNT(id) as stat'), 'status')
                ->groupBy('status')
                ->get();

            foreach ($results as $item) {
                if($item->status == "occupied"){
                    $response .= "Occupied : $item->stat". "\n";
                }else{
                    $response .= "Not Occupied : $item->stat". "\n";
                }
            }

            return response($response, 200)
                ->header('Content-Type', 'text/plain');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            Log::error($th->getMessage());
            return response("Server error", 500)
                ->header('Content-Type', 'text/plain');
        }
    }
}
