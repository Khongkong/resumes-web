@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>編輯履歷</h1>
                <form id="resume-edit" action="/resume/{{$resume->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="resume-title">履歷標題</label>
                        <input type="text" name="title" class="form-control" id="resume-title" value="{{ $resume->title }}">
                    </div>
                    <div class="form-group">
                        <label for="resume-tag">履歷標籤</label>
                        <select class="form-control" name="tags[]" id="resume-tag" multiple="multiple">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="resume-content">履歷內容</label>
                        <textarea name="content" id="resume-content" cols="30" rows="10" class="form-control">{!! $resume->content !!}</textarea>
                    </div>
                    <label>履歷語言</label>
                    @foreach(\App\Enums\ResumeType::getValues() as $val)
                        <div class="form-check">
                            <input class="form-check-input" name="type" type="radio" id="{{ \App\Enums\ResumeType::getDescription($val) }}" value={{ $val }}>
                            <label class="form-check-label" for="type">
                            {{ \App\Enums\ResumeType::getDescription($val) }}
                            </label>
                        </div>
                    @endforeach
                    <hr>
                    <button type="button" class="btn btn-secondary" onclick="window.history.go(-2)">回上一頁</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('content');
        $(() => {
            getTags();
            $('#{{\App\Enums\ResumeType::getDescription((string)$resume->type)}}').attr("checked", "checked");
            $('#resume-tag').select2({
                maximumSelectionLength: 5,
                placeholder: '請選擇標籤'
            });
        })
        
        function getTags(){
            const select = $('#resume-tag');
            const resumeTags = {!! $resume->tags !!}.map(tag => tag.id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: '/tag',
                contentType: "application/json",
                dataType: 'json',
                success: (tags) => {
                    for (let i in tags) {
                        if(resumeTags.includes(tags[i].id)) {
                            select.append(`<option selected value=${tags[i].id}>${tags[i].name}</option>`)
                        } else {
                            select.append(`<option value=${tags[i].id}>${tags[i].name}</option>`)
                        }
                    }
                },
                error: (e) => {
                    console.log("ERROR: ", e);
                },
            });
        }
    </script>
@endsection