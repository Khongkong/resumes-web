@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{$resume->title}}</h1>
            <div class="d-flex bd-highlight mb-3">
            @if ($resume->tags->count() > 0)
                @foreach ($resume->tags as $tag)
                    <button class="btn btn-secondary btn-sm mr-1" onclick="location.href = '/tag/{{$tag->id}}'">{{$tag->name}}</button>
                @endforeach
            @endif
            <div class="button-group ml-auto">
                @if(!Auth::guest())
                <button class="btn btn-secondary" onclick="history.back()">
                    回上一頁
                </button>
                @if(Auth::user()->id == $resume->user_id || Auth::user()->authority == 0)
                        <button class="btn btn-primary" onclick="window.location.href = '/resume/{{$resume->id}}/edit'">修改</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">刪除</button>
                    @endif
                @endif
            </div>
            </div>
            <br><br>
            <div>
                {!! $resume->content !!}
            </div>
            <hr>
            <small>Written on {{$resume->created_at}} by {{$resume->user->name}}</small>
            <hr>
            <div class="card">
                <div class="card-header">評論：</div>
                    <div class="card-body">
                        @foreach ($resume->comments as $comment)
                        <div class="card bg-light p-3 my-2">
                            <div class="row">
                                <div class="col-2 d-flex flex-column bd-highlight ml-1">
                                    <img src="{{asset('duck.jpeg')}}" class="rounded mx-auto mb-1" alt="" width="50px" height="50px">
                                    <small class="mx-auto">{{$comment->user->name}}</small>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    {{$comment->content}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc.delete')    
@endsection