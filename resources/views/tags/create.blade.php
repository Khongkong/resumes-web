@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>新增標籤</h1>
                <form id="tag-create" action="/api/tag" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tag-title">標籤名稱</label>
                        <input type="text" name="name" class="form-control" id="tag-title" value="" placeholder="標籤名稱">
                    </div>
                    <hr>
                    <button type="button" class="btn btn-secondary" onclick=" history.back()">回上一頁</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    </script>
@endsection