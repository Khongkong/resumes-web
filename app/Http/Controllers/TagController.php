<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Redis;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Redis::flushAll();
        // tag 是否有被新增
        $is_added_tag = Redis::get('add_tag:count') ?? 0;
        
        if(!Redis::command('EXISTS' , ['tags']) || $is_added_tag) {
            Redis::set('tags', json_encode(Tag::all()));
            Redis::expire('tags', 3600);
            
            // 重新快取標籤後，把 add_tag:count 降為 0
            if($is_added_tag > 0) {
                Redis::decr('add_tag:count');
            }
        }
        $tags = json_decode(Redis::get('tags'));
        return $tags;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'name' => 'required'
        ));
        $tag = Tag::firstOrNew(
            ['name' => $request->input('name')]
        );
        $tag->save();
        
        // 把新增標籤的行為放入快取
        if(!Redis::command('EXISTS', ['add_tag:count']) || Redis::get('add_tag:count') == 0){
            Redis::incr('add_tag:count');
        }
        return redirect('/tag');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.resume')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    // }
}
