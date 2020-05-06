@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">個人資料</div>
                    <div class="card-body row">
                        <div class="col-2">
                            <img src="/storage/cover_images/{{Auth::user()->cover_image}}" class="rounded mx-auto" alt="" width="100px" height="100px">
                        </div>
                        <div class="col-8">
                            <h3>{{Auth::user()->name}}</h3>
                            <p>Email: {{Auth::user()->email}}</p>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#editProfileModalCenter">修改</button>
                        </div>
                        {{-- @if(count($resumes) > 0)
                            @foreach($resumes as $resume)
                                <div class="card bg-light p-3 my-2">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <h3><a href="/resume/{{$resume->id}}">{{$resume->title}}</a></h3>
                                            <small>
                                                新增時間：{{\Carbon\Carbon::parse($resume->created_at)
                                                ->tz('Europe/London')
                                                ->setTimeZone('Asia/Taipei')->locale('zh_TW')
                                                ->diffForHumans()}}／作者：{{$resume->user->name}}
                                            </small>
                                            <br>
                                            <small>{{$resume->comments->count()}}則留言</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $resumes->render() }}
                        @else
                            <h2>目前沒有任何履歷</h2>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc.edit_profile')
@endsection
