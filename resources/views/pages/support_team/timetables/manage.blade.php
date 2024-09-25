@extends('layouts.master')
@section('page_title', __('msg.manage_timetable_record'))
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">{{ $ttr->name.' ('.$my_class->name.')'.' '.$ttr->year }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#manage-ts" class="nav-link active" data-toggle="tab">{{ __('msg.manage_time_slots') }}</a></li>
                <li class="nav-item"><a href="#add-sub" class="nav-link" data-toggle="tab">{{ __('msg.add_subject') }}</a></li>
                <li class="nav-item"><a href="#edit-subs" class="nav-link " data-toggle="tab">{{ __('msg.edit_subjects') }}</a></li>
                <li class="nav-item"><a target="_blank" href="{{ route('ttr.show', $ttr->id) }}" class="nav-link" >{{ __('msg.view_timetable') }}</a></li>
            </ul>

            <div class="tab-content">
                {{--Add Time Slots--}}
                @include('pages.support_team.timetables.time_slots.index')
                {{--Add Subject--}}
                @include('pages.support_team.timetables.subjects.add')
                {{--Edit Subject--}}
                @include('pages.support_team.timetables.subjects.edit')
            </div>
        </div>
    </div>

    {{--TimeTable Manage Ends--}}

@endsection
