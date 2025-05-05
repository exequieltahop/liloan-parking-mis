<?php

namespace App\Http\Controllers;

use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function getParkingSlots() {
        try {
            return response()->json(ParkingSlot::all());
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
