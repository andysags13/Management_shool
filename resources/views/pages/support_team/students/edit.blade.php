@extends('layouts.master')
@section('page_title', __('msg.edit_student'))
@section('content')

        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 id="ajax-title" class="card-title">{{ __('msg.fill_form_edit_student', ['name' => $sr->user->name]) }}</h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update" data-reload="#ajax-title" action="{{ route('students.update', Qs::hash($sr->id)) }}" data-fouc>
                @csrf @method('PUT')
                <h6>{{ __('msg.personal_data') }}</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.full_name') }}: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->name }}" required type="text" name="name" placeholder="{{ __('msg.full_name') }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.address') }}: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->address }}" class="form-control" placeholder="{{ __('msg.address') }}" name="address" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.email_address') }}: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->email }}" type="email" name="email" class="form-control" placeholder="{{ __('msg.email_address') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{ __('msg.gender') }}: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="{{ __('msg.choose') }}">
                                    <option value=""></option>
                                    <option {{ ($sr->user->gender == 'Male' ? 'selected' : '') }} value="Male">{{ __('msg.male') }}</option>
                                    <option {{ ($sr->user->gender == 'Female' ? 'selected' : '') }} value="Female">{{ __('msg.female') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.phone') }}:</label>
                                <input value="{{ $sr->user->phone }}" type="text" name="phone" class="form-control" placeholder="{{ __('msg.phone') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.telephone') }}:</label>
                                <input value="{{ $sr->user->phone2 }}" type="text" name="phone2" class="form-control" placeholder="{{ __('msg.telephone') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.date_of_birth') }}:</label>
                                <input name="dob" value="{{ $sr->user->dob }}" type="text" class="form-control date-pick" placeholder="{{ __('msg.select_date') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{ __('msg.nationality') }}: <span class="text-danger">*</span></label>
                                <select data-placeholder="{{ __('msg.choose') }}" required name="nal_id" id="nal_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($nationals as $nal)
                                        <option {{ ($sr->user->nal_id == $nal->id ? 'selected' : '') }} value="{{ $nal->id }}">{{ $nal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state_id">{{ __('msg.state') }}: <span class="text-danger">*</span></label>
                                <select onchange="getLGA(this.value)" required data-placeholder="{{ __('msg.choose') }}" class="select-search form-control" name="state_id" id="state_id">
                                    <option value=""></option>
                                    @foreach($states as $st)
                                        <option {{ ($sr->user->state_id == $st->id ? 'selected' : '') }} value="{{ $st->id }}">{{ $st->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lga_id">{{ __('msg.lga') }}: <span class="text-danger">*</span></label>
                                <select data-placeholder="{{ __('msg.choose') }}" required name="lga_id" id="lga_id" class="select-search form-control">
                                    <option value="{{ $sr->user->lga_id }}">{{ $sr->user->lga->name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h6>{{ __('msg.student_data') }}</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_class_id">{{ __('msg.class') }}: <span class="text-danger">*</span></label>
                                <select onchange="getClassSections(this.value)" name="my_class_id" required id="my_class_id" class="form-control select-search" data-placeholder="{{ __('msg.select_class') }}">
                                    <option value=""></option>
                                    @foreach($my_classes as $c)
                                        <option {{ $sr->my_class_id == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id">{{ __('msg.section') }}: </label>
                                <select name="section_id" required id="section_id" class="form-control select" data-placeholder="{{ __('msg.select_section') }}">
                                    <option value="{{ $sr->section_id }}">{{ $sr->section->name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_parent_id">{{ __('msg.parent') }}: </label>
                                <select data-placeholder="{{ __('msg.choose') }}" name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($parents as $p)
                                        <option {{ (Qs::hash($sr->parent_id) == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year_admitted">{{ __('msg.year_admitted') }}: </label>
                                <select name="year_admitted" data-placeholder="{{ __('msg.choose') }}" id="year_admitted" class="select-search form-control">
                                    <option value=""></option>
                                    @for($y = date('Y', strtotime('- 10 years')); $y <= date('Y'); $y++)
                                        <option {{ ($sr->year_admitted == $y) ? 'selected' : '' }} value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="dorm_id">{{ __('msg.dormitory') }}: </label>
                            <select data-placeholder="{{ __('msg.choose') }}" name="dorm_id" id="dorm_id" class="select-search form-control">
                                <option value=""></option>
                                @foreach($dorms as $d)
                                    <option {{ ($sr->dorm_id == $d->id) ? 'selected' : '' }} value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.dormitory_room_no') }}:</label>
                                <input type="text" name="dorm_room_no" placeholder="{{ __('msg.dormitory_room_no') }}" class="form-control" value="{{ $sr->dorm_room_no }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
@endsection