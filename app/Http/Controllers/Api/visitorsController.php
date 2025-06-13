<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\visitors;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\visitorsResource;




class visitorsController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');

         $validator = Validator::make($request->all(), [
                 'date' => 'date',

        ]);
         if ($validator->fails()) {
            return errorResponse('Validation failed.', 422, $validator->errors());
        }

        $cacheKey = 'visitors_' . ($date ?? 'all');

        return Cache::remember($cacheKey, 60, function () use ($date) {
            $query = visitors::select('id', 'location_id', 'sensor_id', 'date', 'total_visitors as count');
            if ($date) {
                $query->whereDate('date', $date);
            }
            $visitorsData = $query->get();

            if (empty($visitorsData)) {
                return errorResponse('Sorry! No record found.', 200);
            }
            return successResponse(visitorsResource::collection($visitorsData));
        });
    }

    public function store(Request $request)
    {

         $validator = Validator::make($request->all(), [

            'location_id' => 'required|exists:locations,id',
            'sensor_id' => 'required|exists:sensors,id',
            'date' => 'required|date',
            'count' => 'required|integer|min:0',
        ]);
         if ($validator->fails()) {
            return errorResponse('Validation failed.', 422, $validator->errors());
        }

        Cache::forget('visitors_all');
        Cache::forget('visitors_' . $request->date);

        try {

            $visitors = visitors::create([
                'location_id' => $request->location_id,
                'sensor_id' => $request->sensor_id,
                'date' => $request->date,
                'total_visitors' => $request->count,
            ]);

            return successResponse([
                'message' => 'Visitor data saved successfully.',

            ], 201);
        } catch (\Exception $e) {
            return errorResponse('Failed to create visitor data.', 500, [$e->getMessage()]);
        }
    }
}
