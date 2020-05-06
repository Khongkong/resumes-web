<!-- Modal -->
<div class="modal fade" id="editProfileModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">修改個人資料</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/update_profile" id="edit-profile" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <img src="/storage/cover_images/{{Auth::user()->cover_image}}" id="cover" class="rounded mx-auto d-block my-3" alt="" width="200px" height="200px" multiple accept='image/*'>
                    <div class="form-group">
                        <input type="file" id="file" name="cover-image" class="form-control file">
                    </div>
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{Auth::user()->email}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">確定修改</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        function preview(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cover').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on("change", "#file", function (){
            preview(this);
        })

    })
    // $(document).ready(() => {
    //     $("#edit-profile").submit((event) => {
    //         event.preventDefault();
    //         ajaxPost();
    //     });
    // });
    function ajaxPost(){
        const data = {
            'comment-content': $('#comment-content').val(),
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
