<?php

namespace App\Http\Controllers;

use App\Models\Epin;

class EpinController extends Controller
{
    function buyEpin()
    {
        try {
            $userid = rand(999999, 999999999).time();
            $epin = Epin::where('status', 'unused')->limit(1)->update(['status' => 'used', 'user_id' => $userid]);

            if ($epin) {
                return Epin::where('user_id', $userid)->orderBy('id', 'desc')->first();
            } else {
                return response()->json([
                    'message' => 'No epin available',
                ], 404);
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Error occurred while processing the request. message: ' . $e->getMessage(),
            ], 500);
        }
    }
}
