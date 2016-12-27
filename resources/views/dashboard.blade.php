@extends('layouts.master')

@section('content')
    <div class="dashboard" id="dashboard">
        <google-calendar grid="a1:a2"></google-calendar>
        <current-time grid="d1" dateformat="ddd DD/MM"></current-time>
    </div>
@endsection