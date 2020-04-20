<script>
    $(document).ready(() => {
        $("#add-comment").submit((event) => {
            event.preventDefault();
            ajaxGet();
        });
    });
    function ajaxGet(){
        const data = {
            'comment-content': $('#comment-content').val(),
            'resume-id': {!! $resume->id !!}
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            contentType: "application/json",
            url: `/comment`,
            dataType: 'json',
            data: JSON.stringify(data),
            success: (comment) => {
                commentResult = document.getElementById('comment');
                commentResult.innerHTML += 
                `<div class="card bg-light p-3 my-2">
                    <div class="row">
                        <div class="col-2 d-flex flex-column bd-highlight ml-1">
                            <img src="{{asset('duck.jpeg')}}" class="rounded mx-auto mb-1" alt="" width="50px" height="50px">
                            <small class="mx-auto">{{ Auth::user()->name }}</small>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            ${comment.content}
                        </div>
                    </div>
                </div>`; 
                $('#comment-content').val('');
            },
            error: (e) => {
                console.log("ERROR: ", e);
            },
        });
    }
</script>