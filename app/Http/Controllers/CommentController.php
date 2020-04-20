<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    protected $comment;
    public function __construct(Comment $comment) 
    {
        $this->comment = $comment;
        $this->middleware('auth');
    }
    public function store(Request $request) 
    {
        $this->validate($request, array(
            'comment-content' => 'required|max:200',
            'resume-id' => 'required',
        ));
        $this->comment->content = $request->input('comment-content');
        $this->comment->resume_id = $request->input('resume-id');
        $this->comment->user_id = auth()->user()->id;
        $this->comment->save();
        return $this->comment;
    }
}
