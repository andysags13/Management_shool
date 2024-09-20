@extends('layouts.master')
@section('page_title', __('msg.manage_promotions'))
@section('content')

    {{--Reset All--}}
    <div class="card">
        <div class="card-body text-center">
            <button id="promotion-reset-all" class="btn btn-danger btn-large">{{ __('msg.reset_all_promotions') }}</button>
        </div>
    </div>

    {{-- Reset Promotions --}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">{{ __('msg.manage_promotions') }} - {{ __('msg.students_promoted_from') }} <span class="text-danger">{{ $old_year }}</span> {{ __('msg.to') }} <span class="text-success">{{ $new_year }}</span> {{ __('msg.session') }}</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <table id="promotions-list" class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>{{ __('msg.sn') }}</th>
                    <th>{{ __('msg.photo') }}</th>
                    <th>{{ __('msg.name') }}</th>
                    <th>{{ __('msg.from_class') }}</th>
                    <th>{{ __('msg.to_class') }}</th>
                    <th>{{ __('msg.status') }}</th>
                    <th>{{ __('msg.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promotions->sortBy('fc.name')->sortBy('student.name') as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $p->student->photo }}" alt="photo"></td>
                        <td>{{ $p->student->name }}</td>
                        <td>{{ $p->fc->name.' '.$p->fs->name }}</td>
                        <td>{{ $p->tc->name.' '.$p->ts->name }}</td>
                        @if($p->status === 'P')
                            <td><span class="text-success">{{ __('msg.promoted') }}</span></td>
                        @elseif($p->status === 'D')
                            <td><span class="text-danger">{{ __('msg.not_promoted') }}</span></td>
                        @else
                            <td><span class="text-primary">{{ __('msg.graduated') }}</span></td>
                        @endif
                        <td class="text-center">
                            <button data-id="{{ $p->id }}" class="btn btn-danger promotion-reset">{{ __('msg.reset') }}</button>
                            <form id="promotion-reset-{{ $p->id }}" method="post" action="{{ route('students.promotion_reset', $p->id) }}">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        /* Single Reset */
        $('.promotion-reset').on('click', function () {
            let pid = $(this).data('id');
            if (confirm('{{ __('msg.confirm_reset') }}')){
                $('form#promotion-reset-'+pid).submit();
            }
            return false;
        });

        /* Reset All Promotions */
        $('#promotion-reset-all').on('click', function () {
            if (confirm('{{ __('msg.confirm_reset_all') }}')){
                $.ajax({
                    url:"{{ route('students.promotion_reset_all') }}",
                    type:'DELETE',
                    data:{ '_token' : $('#csrf-token').attr('content') },
                    success:function (resp) {
                        $('table#promotions-list > tbody').fadeOut().remove();
                        flash({msg : resp.msg, type : 'success'});
                    }
                })
            }
            return false;
        })
    </script>
@endsection