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
        // Redis::command('FLUSHALL');
        
        // resume 是否有被新增
        $is_added_resume = Redis::hGet('user', 'modify_reusme:count') ?? false;
        

        $user_id = auth()->user()->id;
        // dd(Redis::hGet('user', 'id'));
        if(!Redis::command('EXISTS' , ['user']) || $user_id != Redis::hGet('user', 'id') || $is_added_resume){
            Redis::hSet('user', 'id', $user_id);
            $user = User::find($user_id);
            Redis::hSet('user', 'resumes', json_encode($user->resumes));
            
            // 重新快取標籤後，把 add_resume:count 降為 0
            Redis::hSet('user', 'modify_reusme:count', 0);
            
            Redis::expire('user', 3600);
        }
        $resumes = json_decode(Redis::hGet('user', 'resumes'));
        return view('home')->withResumes($resumes);
    }
}
