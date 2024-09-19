@extends('layouts.master')
@section('page_title', __('msg.my_dashboard'))

@section('content')
    <h2>{{ __('msg.welcome', ['name' => Auth::user()->name]) }}. {{ __('msg.this_is_your_dashboard') }}</h2>
@endsection