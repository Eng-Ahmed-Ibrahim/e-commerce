<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function mark_read(Request $request){
        $notification = auth()->user()->notifications()->find($request->notification_id);

        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(["message"=>"Updated Successfullu"]);
    }
}
