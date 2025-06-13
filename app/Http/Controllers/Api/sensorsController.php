<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sensors;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\sensorsResource;



class sensorsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $status = $request->query('status');
            $page = $request->query('page', 1); // For cache key uniqueness
            $cacheKey = 'sensors_' . ($status ?? 'all') . '_page_' . $page;

            $sensors = Cache::remember($cacheKey, 60, function () use ($status) {
                $query = sensors::select('id', 'name', 'status', 'location_id')->with('location');

                if ($status) {
                    $query->where('status', $status);
                }

                return $query->paginate(10); // Pagination applied
            });

            // Handling empty result
            if ($sensors->isEmpty()) {
                return errorResponse('Sorry! No record found.', 200);
            }

            return successResponse(sensorsResource::collection($sensors));
        } catch (\Exception $e) {
            return errorResponse('Failed to fetch sensors.', 500, [$e->getMessage()]);
        }
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'location_id' => 'required|exists:locations,id', //validate if location exists
        ]);

        if ($validator->fails()) {
            return errorResponse('Validation failed.', 422, $validator->errors());
        }

        try {
            $sensor = sensors::create([
                'name' => $request->name,
                'status' => $request->status,
                'location_id' => $request->location_id,
            ]);
            Cache::forget('sensors_all');

              return successResponse([
                'message' => 'Sensor created successfully.',

            ], 201);
        } catch (\Exception $e) {
            return errorResponse('Failed to create sensor.', 500, [$e->getMessage()]);
        }
    }
}
