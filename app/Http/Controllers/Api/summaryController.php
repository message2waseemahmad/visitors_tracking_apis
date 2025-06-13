<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sensors;
use App\Models\visitors;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\summaryResource;




class summaryController extends Controller
{

public function index()
{
    $summary = Cache::remember('summary', 15, function () {  // cache time can be increased
        $totalVisitors = visitors::where('date', '>=', now()->subDays(7)->toDateString())
            ->sum('total_visitors');

        $sensorStats = sensors::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'total_visitors_last_7_days' => $totalVisitors,
            'sensor_status' => [
                'active' => $sensorStats['active'] ?? 0,
                'inactive' => $sensorStats['inactive'] ?? 0,
            ],
        ];
    });


            return successResponse(new summaryResource($summary));


}


}
