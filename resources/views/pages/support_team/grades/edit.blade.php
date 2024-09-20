@extends('layouts.master')
@section('page_title', __('msg.edit_grade'))
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">{{ __('msg.edit_grade') }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('grades.update', $gr->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.name') }} <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="{{ $gr->name }}" required type="text" class="form-control" placeholder="{{ __('msg.name_example') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.grade_type') }}</label>
                            <div class="col-lg-9">
                                <select class="form-control select" name="class_type_id" id="class_type_id">
                                    <option value="">{{ __('msg.not_applicable') }}</option>
                                    @foreach($class_types as $ct)
                                        <option {{ $gr->class_type_id == $ct->id ? 'selected' : '' }} value="{{ $ct->id }}">{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.mark_from') }} <span class="text-danger">*</span></label>
                            <div class="col-lg-3">
                                <input name="mark_from" min="0" max="100" value="{{ $gr->mark_from }}" required type="number" class="form-control" placeholder="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.mark_to') }} <span class="text-danger">*</span></label>
                            <div class="col-lg-3">
                                <input name="mark_to" min="0" max="100" value="{{ $gr->mark_to }}" required type="number" class="form-control" placeholder="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remark" class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.remark') }}</label>
                            <div class="col-lg-9">
                                <select class="form-control select" name="remark" id="remark">
                                    <option value="">{{ __('msg.select_remark') }}</option>
                                    @foreach(Mk::getRemarks() as $rem)
                                        <option {{ $gr->remark == $rem ? 'selected' : '' }} value="{{ $rem }}">{{ $rem }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ __('msg.submit_form') }} <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Grade Edit Ends--}}

@endsection