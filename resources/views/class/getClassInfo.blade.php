<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form action="{{ route('post_edit_class_route', ['id' => $classOb->id]) }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CẬP NHẬT LỚP HỌC</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên lớp học:</label>
                    <input class="form-control" type="text" name="txtEditClassName" value="{{ $classOb->name }}">
                </div>
                <div class="form-group">
                    <label>Khóa học: </label>
                    <select class="form-control selectpicker" data-live-search="true" name="slEditClassScienceId">
                        @foreach($scienceList as $science)
                        <option value="{{ $science->id }}" {{ $science->id == $classOb->science_id ? 'selected' : ''}}>{{ $science->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
