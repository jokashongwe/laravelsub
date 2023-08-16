<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Show the posts for a given user.
     */
    public function show(string $id)
    {
        return response()->json(Subscription::findOrFail($id));
    }

    /**
     * Show the posts for a given user.
     */
    public function all()
    {
        return response()->json(Subscription::all());
    }

    /**
     * Show the posts for a given user.
     */
    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'website_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::find($request->get('user_id'));
        if (empty($user)) {
            return response()->json([
                'message' => "User not found for id=" . $request->get('user_id'),
            ], 404);
        }
        $website = Website::find($request->get('website_id'));
        if (empty($website)) {
            return response()->json([
                'message' => "website not found for id=" . $request->get('user_id'),
            ], 404);
        }

        try {
            $substription = Subscription::create($request->all());

            return response()->json([
                'message' => 'website successfully registered',
                'website' => $substription
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
