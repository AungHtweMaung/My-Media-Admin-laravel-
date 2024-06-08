<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    // direct trend post page
    public function index()
    {
        // actionlog table က post table နဲ့ rs ချိတ်တယ်၊
        // actionlog table ထဲက တူတဲ့ post_id တွေကို group လုပ်ပြီး၊ post view count ကို select လုပ်ပြီး ယူတယ်
        $posts = ActionLog::leftJoin(
            'posts',
            'posts.id',
            'action_logs.post_id'
        )->select(
            'posts.*',
            'posts.id as trend_post_id',
            'action_logs.*',
            // 'action_logs.id as action_log_id',
            DB::raw('COUNT(action_logs.post_id) as post_view_count')
        )

            ->groupBy('action_logs.post_id')
            ->get();

        // dd($posts->toArray());
        return view('admin.trend_post.index', compact('posts'));
    }

    // trend post details
    public function details($id)
    {
        $trend_post = Post::where('id', $id)->firstorfail();

        // dd($trend_post);
        return view('admin.trend_post.details', compact('trend_post'));
    }
}
