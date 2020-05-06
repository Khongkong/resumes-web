<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Enums\ResumeType;
use Illuminate\Support\Facades\Redis;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Support\Facades\Gate;

class ResumeController extends Controller
{
    private const MAX_RESUME_NUMBER = 3;
    protected $resume;

    public function __construct(Resume $resume) {
        $this->resume = $resume;
        $this->middleware('auth')->except('index');
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
        // $resume = new Resume;
        $this->resume->title = $request->input('title');
        $this->resume->content = $request->input('content');
        $this->resume->type = $request->input('type');
        $this->resume->user_id = $request->input('user');
        $this->resume->save();
        $this->resume->tags()->attach($request->input('tags'));
        $this->resume->save();

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
        if(Gate::allows('edit-or-delete-resume', $resume)){
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
        $resume->comments()->delete();
        $resume->delete();

        Redis::hSet('user', 'modify_reusme:count', 1);
        return redirect('/home');
    }
}
