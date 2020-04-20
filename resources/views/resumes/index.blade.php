@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">所有履歷</div>
                    <div class="card-body">
                        @if(count($resumes) > 0)
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection