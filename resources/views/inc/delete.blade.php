<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">你即將要刪除這篇履歷</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                刪除的履歷就再也回不來囉，確定要刪除嗎？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <form action="/api/resume/{{$resume->id}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">確定刪除</button>
                </form>
            </div>
        </div>
    </div>
</div>