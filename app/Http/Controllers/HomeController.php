<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Resume;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Redis::command('FLUSHALL');
        $user_id = auth()->user()->id;
        if(!Redis::command('EXISTS' , ['user']) || $user_id !== Redis::hGet('user', 'id')){
            Redis::hSet('user', 'id', $user_id);
            $user = User::find($user_id);
            Redis::hSet('user', 'resumes', json_encode($user->resumes));
            
            Redis::expire('user', 300);
        }
        $resumes = json_decode(Redis::hGet('user', 'resumes'));
        return view('home')->withResumes($resumes);
    }
}
