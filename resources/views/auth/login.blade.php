@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 20px;">
            <img class="img-responsive" src="{{ URL::asset('public/images/banner.png') }}">
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('post_login_route') }}">
                        {{ csrf_field() }}
                        @if (session('error'))
                        <ul>
                            <li class="text-danger"> {{ session('error') }}</li>
                        </ul>
                        @endif

                        <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                            <label for="student_id" class="col-md-4 control-label">MSSV: </label>

                            <div class="col-md-6">
                                <input id="student_id" type="student_id" class="form-control" name="student_id" value="{{ old('student_id') }}" required autofocus>

                                @if ($errors->has('student_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu: </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div class="col-md-5">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
