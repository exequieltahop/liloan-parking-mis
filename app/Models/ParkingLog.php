<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ParkingLog extends Model
{
    protected $fillable = [
        'slot_no',
        'type',
    ];

    // get total logs count
    public static function getTotalLogCount()
    {
        return self::count();
    }

    // todays parking
    public static function getTodaysTotalParking()
    {
        return self::whereDate('created_at', Carbon::now('Asia/Manila'))
            ->count();
    }

    // get months
    public static function getMonths($year)
    {
        return self::select(
            DB::raw('MONTH(created_at) as month_number'),
            DB::raw('DATE_FORMAT(created_at, "%M") as month')
        )
            ->distinct()
            ->whereYear('created_at', $year)
            ->orderBy('month_number', 'asc')
            ->pluck('month')
            ->toArray();
    }

    // get data per m
    public static function getDataPerMonthPerSlot($slot, $year)
    {
        return self::selectRaw('COUNT(*) AS total, MONTH(created_at) AS number_month')
            ->where('slot_no', $slot)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('number_month', 'asc')
            ->get()
            ->toArray();
    }
}
