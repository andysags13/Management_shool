@extends('layouts.master')
@section('page_title', __('msg.student_promotion'))
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">{{ __('msg.student_promotion_from') }} <span class="text-danger">{{ $old_year }}</span> {{ __('msg.to') }} <span class="text-success">{{ $new_year }}</span> {{ __('msg.session') }}</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @include('pages.support_team.students.promotion.selector')
        </div>
    </div>

    @if($selected)
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">{{ __('msg.promote_students_from') }} <span class="text-teal">{{ $my_classes->where('id', $fc)->first()->name.' '.$sections->where('id', $fs)->first()->name }}</span> {{ __('msg.to') }} <span class="text-purple">{{ $my_classes->where('id', $tc)->first()->name.' '.$sections->where('id', $ts)->first()->name }}</span> </h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @include('pages.support_team.students.promotion.promote')
        </div>
    </div>
    @endif

    {{--Student Promotion End--}}

@endsection