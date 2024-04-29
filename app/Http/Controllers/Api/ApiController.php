<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Settings;

class ApiController
{

    public function __construct()
    {
    }

    public function index()
    {
        $data = Category::where('status', 1)->where(function($q) {
            $q->where('parent_id', null)->orWhere('parent_id', 0);
        })->with(['children' => function($q1) {
            $q1->where('status', 1);
        }])->with(['products' => function($q1) {
            $q1->where('status', 1);
        }])->orderBy('sort', 'asc');
        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => 'success',
            'data' => [
                'items' => CategoryResource::collection($data->get()),
                'settings' => Settings::first()
            ]
        ], 200);
    }

}

?>