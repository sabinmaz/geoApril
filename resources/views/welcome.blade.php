@extends('layouts.master')
@section('content')
    <div id="app">

        <heading></heading>
        {{--<div class="flex-center position-ref full-height">--}}
        <router-view></router-view>
        {{--</div>--}}
    </div>
@endsection