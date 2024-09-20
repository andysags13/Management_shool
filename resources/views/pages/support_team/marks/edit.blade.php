<form class="ajax-update" action="{{ route('marks.update', [$exam_id, $my_class_id, $section_id, $subject_id]) }}" method="post">
    @csrf @method('put')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>{{ __('msg.sn') }}</th>
            <th>{{ __('msg.name') }}</th>
            <th>{{ __('msg.adm_no') }}</th>
            <th>{{ __('msg.first_ca') }} (20)</th>
            <th>{{ __('msg.second_ca') }} (20)</th>
            <th>{{ __('msg.exam') }} (60)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($marks->sortBy('user.name') as $mk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mk->user->name }} </td>
                <td>{{ $mk->user->student_record->adm_no }}</td>

                {{-- CA AND EXAMS --}}
                <td><input title="{{ __('msg.first_ca') }}" min="1" max="20" class="text-center" name="t1_{{ $mk->id }}" value="{{ $mk->t1 }}" type="number"></td>
                <td><input title="{{ __('msg.second_ca') }}" min="1" max="20" class="text-center" name="t2_{{ $mk->id }}" value="{{ $mk->t2 }}" type="number"></td>
                <td><input title="{{ __('msg.exam') }}" min="1" max="60" class="text-center" name="exm_{{ $mk->id }}" value="{{ $mk->exm }}" type="number"></td>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">{{ __('msg.update_marks') }} <i class="icon-paperplane ml-2"></i></button>
    </div>
</form>