@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">所有標籤</div>
                    <div class="card-body" id="tag-item">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(() => {
        getTags();
    })

    function getTags(){
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
                const div = $('#tag-item')
                for (let i in tags) {
                    div.append(`
                    <div class="card bg-light p-3 my-2">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h3><a href="/tag/${tags[i].id}">${tags[i].name}</a></h3>
                            </div>
                        </div>
                    </div>`)
                }
            },
            error: (e) => {
                console.log("ERROR: ", e);
            },
        });
    }
</script>
@endsection
