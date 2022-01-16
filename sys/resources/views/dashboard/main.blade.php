@extends('layouts.auth')

@section('content')

Hello {{ Auth::user()->name }}

<a href="javascript:void" onclick="$('#logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@stop