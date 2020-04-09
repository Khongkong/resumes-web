<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Enums\UserType;
use App\Enums\ResumeType;
use Illuminate\Support\Facades\Redis;
use BenSampo\Enum\Rules\EnumValue;

class ResumeController extends Controller
{
    private const MAX_RESUME_NUMBER = 3;

    public function __construct() {
        $this->middleware('auth')->except(['index', 'update', 'store', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = Resume::orderBy('created_at','desc')->paginate(7);
        return view('resumes.index')->withResumes($resumes);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $resumeNumber = Resume::where('user_id', '=', $user_id)->count();
        if($resumeNumber < self::MAX_RESUME_NUMBER){
            return view('resumes.create');
        }
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'tags' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
            'type' => ['required', new EnumValue(ResumeType::class)]
        ));
        $resume = new Resume;
        $resume->title = $request->input('title');
        $resume->content = $request->input('content');
        $resume->type = $request->input('type');
        $resume->user_id = $request->input('user');
        $resume->save();
        $resume->tags()->attach($request->input('tags'));
        $resume->save();

        // 把新增履歷的行為放入快取
        Redis::hSet('user', 'modify_reusme:count', 1);
        
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resume = Resume::find($id);
        return view('resumes.show')->withResume($resume);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resume = Resume::find($id);
        $isAdmin = auth()->user()->authority == UserType::SuperAdmin;
        $isUser = auth()->user()->id == $resume->user_id;
        if($isUser || $isAdmin){
            return view('resumes.edit')->withResume($resume);
        }
        return redirect('/resume');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'tags' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
            'type' =>  ['required', new EnumValue(ResumeType::class)]
        ));
		$resume = Resume::find($id);
        // Update resume
        $resume->title = $request->input('title');
        $resume->content = $request->input('content');
        $resume->type = $request->input('type');

        // many-to-many relationship (tags) sync
        $resume->tags()->sync($request->input('tags'));
        
        // $resume->user_id = auth()->user()->id;
        $resume->save();
        return redirect('/home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resume = Resume::find($id);
        $resume->tags()->detach();
        $resume->delete();
        
        Redis::hSet('user', 'modify_reusme:count', 1);
        return redirect('/home');
    }
}
