@extends('layouts.default')
@section('title', '登錄')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>登錄</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('static::login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">電子信箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密碼：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> 記住我</label>
                    </div>

                    <button type="submit" class="btn btn-primary">登錄</button>
                </form>

                <hr>

                <p>還沒帳號？<a href="{{ route('user::signup') }}">註冊去！</a></p>
            </div>
        </div>
    </div>
@stop