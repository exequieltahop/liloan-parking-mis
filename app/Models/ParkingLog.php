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
    public static function getMonths($year) {
        return self::select(DB::raw('DATE_FORMAT(created_at, "%M") as month'))
                ->distinct()
                ->whereYear('created_at', $year)
                ->orderBy('month', 'asc')
                ->pluck('month')
                ->toArray();
    }
}
