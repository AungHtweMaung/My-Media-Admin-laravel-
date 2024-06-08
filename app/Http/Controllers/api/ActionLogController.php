<?php

namespace App\Http\Controllers\api;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;

class ActionLogController extends Controller
{
    // view count
    public function viewCount(Request $request)
    {

        $data = [
            'user_id'=>$request->userId,
            'post_id' => $request->postId
        ];

        ActionLog::create($data);

        $actionLogData = ActionLog::where('post_id', $request->postId)->get();

        return response()->json(['post' => $actionLogData]);
    }
}
