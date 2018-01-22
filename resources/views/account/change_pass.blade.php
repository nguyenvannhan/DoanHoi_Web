@extends('master')

@section('title_site', "IT's CYU | Thêm danh sách SV")

@section('header_page')
<div class="page-title">
    <div class="title_left">
        <h1>Đổi mật khẩu</h1>
    </div>
</div>
@stop

@section('main_content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3">
        @if(count($errors) > 0)
        <div class="col-md-12 col-xs-12 col-sm-12 form-group">
            <ul class="alert alert-danger">
                @foreach($errors as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(isset($success_alert))
        <div class="col-md-12 col-xs-12 col-sm-12 form-group">
            <ul class="alert alert-success">
                <li>{{ $success_alert }}</li>
            </ul>
        </div>
        @endif

        <form class="form-horizontal" action="{{ route('post_change_pass_route') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-4">Mật khẩu hiện tại: </label>
                <div class="col-md-8">
                    <input class="form-control" type="password" name="current_pass" value="{{ $currentPass or '' }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Mật khẩu mới: </label>
                <div class="col-md-8">
                    <input class="form-control" type="password" name="new_pass" value="{{ $newPass or '' }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nhập lại: </label>
                <div class="col-md-8">
                    <input class="form-control" type="password" name="confirm_pass" value="{{ $confirmPass or '' }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-md-offset-5">
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
