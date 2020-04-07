@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">所有在標籤「{{$tag->name}}」下的履歷</div>
                    <div class="card-body">
                        @if(count($tag->resumes) > 0)
                            @foreach($tag->resumes as $resume)
                                <div class="card bg-light p-3 my-2">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <h3><a href="/resume/{{$resume->id}}">{{$resume->title}}</a></h3>
                                            <small>Written on {{$resume->created_at}} by {{$resume->user->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2>目前沒有任何履歷</h2>
                        @endif
                    </div>
                    <button class="btn btn-secondary" onclick="window.history.back()">
                        回上一頁
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection