<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request)
    {

        if ($this->countPosts($request) > 4) {

            return response()->json([
                'post_id' => $request->post_id,
                'message' => "You have reached the maximum number of votes. Wait for 24 hours",
                'count' => $this->gettotalVotes($request)
            ]);
        }

        if ($this->checkPostLike($request) == 1) {

            return response()->json([
                'post_id' => $request->post_id,
                'message' => "You already voted. Please vote for any contestant",
                'count' => $this->gettotalVotes($request)

            ]);
        }


        Vote::create([
            'post_id' => $request->post_id,
            'user_id' =>  Auth::user()->id ?? 1,
            'vote' => true,
            'ip_address' => $request->ip(),
            'date' => Carbon::now()
        ]);

        return response()->json([
            'post_id' => $request->post_id,
            'message' => "Voted",
            'count' => $this->gettotalVotes($request)
        ]);
    }

    private function checkPostLike(Request $request)
    {
        if (Auth::check()) {
            $matchThese = [
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,

            ];

            if (Auth::check()) {
                $post = Vote::with(['user', 'post'])->where('user_id', Auth::user()->id)
                    ->where('post_id', $request->post_id)
                    ->where('date', '>', Carbon::now()->subHours(24)->toDateTimeString())
                    ->get();
            }
        } else {


            $post = Vote::with(['user', 'post'])->where('ip_address',  $request->ip())
                ->where('post_id', $request->post_id)
                ->where('date', '>', Carbon::now()->subHours(24)->toDateTimeString())
                ->get();
        }



        if ($post->isEmpty()) {
            return 0;
        }
        return 1;
    }

    private function countPosts(Request $request)
    {


        if (Auth::check()) {
            $countposts = Vote::where('user_id', Auth::user()->id)
                ->where('date', '>', Carbon::now()->subHours(24)->toDateTimeString())
                ->count();
        } else {
            $countposts = Vote::where('ip_address', $request->ip())
                ->where('date', '>', Carbon::now()->subHours(24)->toDateTimeString())
                ->count();
        }


        return $countposts;
    }




    public function gettotalVotes(Request $request)
    {


        $totalvotes = Vote::where('post_id', $request->post_id)->sum('vote');
        return $totalvotes;
    }


    public function testCountPosts(Request $request)
    {
        if (Auth::check() == true) {
            $countposts = Vote::where('user_id', Auth::user()->id)
                ->where('date', '>', Carbon::now()->subHours(24)->toDateTimeString())
                ->count();
        } else {
            $countposts = Vote::where('ip_address', $request->ip())
                ->where('date', '>', Carbon::now()->subHours(24)->toDateTimeString())
                ->count();
        }



        dd($countposts);
    }

    public function authTest()
    {

        dd(Auth::user()->id);
    }
}
