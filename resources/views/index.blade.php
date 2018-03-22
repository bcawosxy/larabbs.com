@extends('layouts.default')
@section('title', 'Larabbs Home')
@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <h3>列表</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>...</h1>
            <p class="lead">
                ...
            </p>
            <p>
                <a class="btn btn-lg btn-success" href="{{route('static::login')}}" role="button">Login</a>
            </p>
        </div>
    @endif
@stop
