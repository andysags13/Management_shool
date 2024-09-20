@extends('layouts.master')
@section('page_title', __('msg.generate_pins'))
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-alarm mr-2"></i> {{ __('msg.generate_pins') }}</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="{{ route('pins.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="pin_count" class="font-weight-bold col-form-label">{{ __('msg.generate_pins') }} ({{ __('msg.enter_amount_of_pins') }}) </label>
                            <input class="form-control form-control-lg" placeholder="{{ __('msg.enter_number_between') }}" required name="pin_count" type="text">
                        </div>

                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('msg.submit') }} <i class="icon-paperplane ml-2"></i></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection