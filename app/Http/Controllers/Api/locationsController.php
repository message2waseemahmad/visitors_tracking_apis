<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\locationsResource;

use App\Models\locations;


class locationsController extends Controller
{

    public function index()
    {
        try {
            $locations = locations::select('id','name')->get();

            if ($locations->isEmpty()) {
                return errorResponse('Sorry! No record found.', 200);
            }

            return successResponse(locationsResource::collection($locations));



        } catch (\Exception $e) {
            return errorResponse('Failed to fetch locations.', 500, [$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return errorResponse('Validation failed.', 422, $validator->errors());
        }

        try {
            $location = locations::create([
                'name' => $request->name,
            ]);

            return successResponse([
                'message' => 'Location created successfully.',
            ], 201);
        } catch (\Exception $e) {
            return errorResponse('Failed to create location.', 500, [$e->getMessage()]);
        }
    }
}
