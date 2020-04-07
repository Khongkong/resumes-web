@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{$resume->title}}</h1>
            @if (count($resume->tags) > 0)
                @foreach ($resume->tags as $tag)
                    <button class="btn btn-secondary btn-sm">{{$tag->name}}</button>
                @endforeach
            @endif
            <br><br>
            <div>
                {!! $resume->content !!}
            </div>
            <hr>
            <small>Written on {{$resume->created_at}} by {{$resume->user->name}}</small>
            <hr>
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
</div>
@include('inc.delete')    
@endsection