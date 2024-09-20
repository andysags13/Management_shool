@extends('layouts.master')
@section('page_title', __('msg.admit_student'))
@section('content')
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">{{ __('msg.fill_form_admit_student') }}</h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('students.store') }}" data-fouc>
               @csrf
                <h6>{{ __('msg.personal_data') }}</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.full_name') }}: <span class="text-danger">*</span></label>
                                <input value="{{ old('name') }}" required type="text" name="name" placeholder="{{ __('msg.full_name') }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.address') }}: <span class="text-danger">*</span></label>
                                <input value="{{ old('address') }}" class="form-control" placeholder="{{ __('msg.address') }}" name="address" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.email_address') }}: </label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="{{ __('msg.email_address') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{ __('msg.gender') }}: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="{{ __('msg.choose') }}">
                                    <option value=""></option>
                                    <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">{{ __('msg.male') }}</option>
                                    <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">{{ __('msg.female') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.phone') }}:</label>
                                <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="{{ __('msg.phone') }}" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.telephone') }}:</label>
                                <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="{{ __('msg.telephone') }}" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.date_of_birth') }}:</label>
                                <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="{{ __('msg.select_date') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{ __('msg.nationality') }}: <span class="text-danger">*</span></label>
                                <select data-placeholder="{{ __('msg.choose') }}" required name="nal_id" id="nal_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($nationals as $nal)
                                        <option {{ (old('nal_id') == $nal->id ? 'selected' : '') }} value="{{ $nal->id }}">{{ $nal->name }}</option>
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
                                        <option {{ (old('state_id') == $st->id ? 'selected' : '') }} value="{{ $st->id }}">{{ $st->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lga_id">{{ __('msg.lga') }}: <span class="text-danger">*</span></label>
                                <select required data-placeholder="{{ __('msg.select_state_first') }}" class="select-search form-control" name="lga_id" id="lga_id">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bg_id">{{ __('msg.blood_group') }}: </label>
                                <select class="select form-control" id="bg_id" name="bg_id" data-fouc data-placeholder="{{ __('msg.choose') }}">
                                    <option value=""></option>
                                    @foreach(App\Models\BloodGroup::all() as $bg)
                                        <option {{ (old('bg_id') == $bg->id ? 'selected' : '') }} value="{{ $bg->id }}">{{ $bg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">{{ __('msg.upload_passport_photo') }}:</label>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">{{ __('msg.accepted_images') }}</span>
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
                                <select onchange="getClassSections(this.value)" data-placeholder="{{ __('msg.choose') }}" required name="my_class_id" id="my_class_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($my_classes as $c)
                                        <option {{ (old('my_class_id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id">{{ __('msg.section') }}: <span class="text-danger">*</span></label>
                                <select data-placeholder="{{ __('msg.select_class_first') }}" required name="section_id" id="section_id" class="select-search form-control">
                                    <option {{ (old('section_id')) ? 'selected' : '' }} value="{{ old('section_id') }}">{{ (old('section_id')) ? 'Selected' : '' }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_parent_id">{{ __('msg.parent') }}: </label>
                                <select data-placeholder="{{ __('msg.choose') }}" name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($parents as $p)
                                        <option {{ (old('my_parent_id') == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year_admitted">{{ __('msg.year_admitted') }}: <span class="text-danger">*</span></label>
                                <select data-placeholder="{{ __('msg.choose') }}" required name="year_admitted" id="year_admitted" class="select-search form-control">
                                    <option value=""></option>
                                    @for($y = date('Y', strtotime('- 10 years')); $y <= date('Y'); $y++)
                                        <option {{ (old('year_admitted') == $y) ? 'selected' : '' }} value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dorm_id">{{ __('msg.dormitory') }}: </label>
                                <select data-placeholder="{{ __('msg.choose') }}" name="dorm_id" id="dorm_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($dorms as $d)
                                        <option {{ (old('dorm_id') == $d->id) ? 'selected' : '' }} value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.dormitory_room_no') }}:</label>
                                <input type="text" name="dorm_room_no" placeholder="{{ __('msg.dormitory_room_no') }}" class="form-control" value="{{ old('dorm_room_no') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.sport_house') }}:</label>
                                <input type="text" name="house" placeholder="{{ __('msg.sport_house') }}" class="form-control" value="{{ old('house') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('msg.admission_number') }}:</label>
                                <input type="text" name="adm_no" placeholder="{{ __('msg.admission_number') }}" class="form-control" value="{{ old('adm_no') }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
@endsection