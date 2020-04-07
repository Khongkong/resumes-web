@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>新增履歷</h1>
                <form id="resume-create" action="/api/resume" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="user" class="form-control" id="user-name" value="{{Auth::user()->id}}" style="display:none">
                    </div>
                    <div class="form-group">
                        <label for="resume-title">履歷標題</label>
                        <input type="text" name="title" class="form-control" id="resume-title" value="" placeholder="履歷標題">
                    </div>
                    <div class="form-group">
                        <label for="resume-tag">履歷標籤</label>
                        <select class="form-control" name="tags[]" id="resume-tag" multiple="multiple">
                            <option disabled>選擇標籤</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="resume-content">履歷內容</label>
                        <textarea name="content" id="resume-content" cols="30" rows="10" class="form-control" placeholder="履歷內容"></textarea>
                    </div>
                    <label>履歷語言</label>
                    <div class="form-check">
                        <input class="form-check-input" name="type" type="radio" id="type-mandarin" value=1>
                        <label class="form-check-label" for="type">
                        中文
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="type" type="radio" id="type-english" value=0>
                        <label class="form-check-label" for="type">
                        英文
                        </label>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-secondary" onclick=" location.href = '/resume'">回上一頁</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        CKEDITOR.replace('content');
        $(() => {
            getTags();
        })
        const select = $('#resume-tag');
        function getTags(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: '/api/tag',
                contentType: "application/json",
                dataType: 'json',
                success: (tags) => {
                    for (let i in tags) {
                        select.append(`<option value=${tags[i].id}>${tags[i].name}</option>`)
                    }
                },
                error: (e) => {
                    console.log("ERROR: ", e);
                },
            });
        }
    </script>
@endsection