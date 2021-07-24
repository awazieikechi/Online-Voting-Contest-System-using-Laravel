<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use App\Models\Vote;
use App\Models\User;


class UserController extends Controller
{


    public function destroy()

    {
        auth()->logout();

        return redirect('/');
    }

    public function showContest()

    {

        $posts = Post::with('user')->where('is_new', 1)->get();

        return view('pages.contest', ['posts' => $posts]);
    }

    public function showRule()

    {

        return view('pages.rule');
    }

    public function showDashboard()

    {

        if (Auth::user()->is_admin == 1) {
            $posts = Post::with('user')->where('is_new', 1)->get();
            return view('pages.dashboard_admin', ['posts' => $posts]);
        }

        if (Auth::check()) {
            return redirect('/user');
        }

        return redirect('/');
    }

    public function showVoters()

    {

        if (Auth::user()->is_admin == 1) {
            $users = User::where('is_contestant', 0)->get();
            return view('pages.dashboard_admin_user', ['users' => $users]);
        }

        if (Auth::check()) {
            return redirect('/user');
        }

        return redirect('/');
    }


    public function mail()
    {
        $user = [
            'name' => 'test',
            'email' => 'ikechiawazie@gmail.com',

        ];
        Mail::to('ikechiawazie@gmail.com')->send(new WelcomeMail($user));

        return 'Email has been sent';
    }
}
