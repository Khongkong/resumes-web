@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">你的履歷</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($resumes) > 0)
                        @foreach($resumes as $resume)
                            <div class="card bg-light p-3 my-2">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <h3><a href="/resume/{{$resume->id}}">{{$resume->title}}</a></h3>
                                        <small>新增時間：{{date('y-m-d h:m:s',strtotime($resume->created_at))}}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2>目前沒有任何履歷</h2>
                    @endif
                </div>
                @if (count($resumes) < 3)
                    <button class="btn btn-primary" onclick="window.location.href='/resume/create'">建立新履歷</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
