<div class="tab-pane fade" id="add-sub">
    <div class="col-md-8">
        <form class="ajax-store" method="post" action="{{ route('tt.store') }}">
            @csrf <input name="ttr_id" value="{{ $ttr->id }}" type="hidden">

            @if($ttr->exam_id)
                {{--EXAM DATE--}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.exam_date') }} <span
                                class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input autocomplete="off" name="exam_date" value="{{ old('exam_date') }}" required type="text" class="form-control date-pick" placeholder="{{ __('msg.select_date') }}">
                    </div>
                </div>

            @else
                {{--DAY--}}
                <div class="form-group row">
                    <label for="day" class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.day') }} <span class="text-danger">*</span></label>

                    <div class="col-lg-9">
                        <select id="day" name="day" required type="text" class="form-control select"
                                data-placeholder="{{ __('msg.select_day') }}">
                            <option value=""></option>
                            @foreach(Qs::getDaysOfTheWeek() as $dw)
                                <option {{ old('day') == $dw ? 'selected' : '' }} value="{{ $dw }}">{{ $dw }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

            @endif

            {{--SUBJECT--}}
            <div class="form-group row">
                <label for="subject_id" class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.subject') }}
                    <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select required data-placeholder="{{ __('msg.select_subject') }}"
                            class="form-control select-search" name="subject_id" id="subject_id">
                        <option value=""></option>
                        @foreach($subjects as $sub)
                            <option {{ old('subject_id') == $sub->id ? 'selected' : '' }} value="{{ $sub->id }}">{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--TIME SLOT--}}
            <div class="form-group row">

                <label for="ts_id" class="col-lg-3 col-form-label font-weight-semibold">{{ __('msg.time_slot') }} <span
                            class="text-danger">*</span></label>

                <div class="col-lg-9">
                    <select data-placeholder="{{ __('msg.select_time') }}" required class="select form-control" name="ts_id"
                            id="ts_id">

                        <option value=""></option>
                        @foreach($time_slots as $tms)
                            <option {{ old('ts_id') == $tms->full ? 'selected' : '' }} value="{{ $tms->id }}">{{ $tms->full}}</option>
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