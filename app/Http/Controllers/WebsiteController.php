<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    /**
     * Show the posts for a given user.
     */
    public function show(string $id)
    {
        return response()->json(Website::findOrFail($id));
    }

    /**
     * Show the posts for a given user.
     */
    public function all()
    {
        return response()->json(Website::all());
    }

    /**
     * Show the posts for a given user.
     */
    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'url' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $website = Website::create($validator->validated());
        return response()->json([
            'message' => 'website successfully registered',
            'website' => $website
        ], 201);
    }
}
