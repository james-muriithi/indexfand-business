@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="font-weight-bolder h5">{{ $settings1['chart_title'] }}</div>
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-success">
                                <div class="card-body pb-0">
                                    <div class="font-weight-bolder h5">{{ $settings2['chart_title'] }}</div>
                                    <div class="text-value">Ksh. {{ number_format($settings2['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white bg-warning">
                                <div class="card-body pb-0">
                                    <div class="font-weight-bold h5">{{ $settings3['chart_title'] }}</div>
                                    <div class="text-value">Ksh. {{ number_format($settings3['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>

                        <div class="{{ $settings6['column_class'] }}">
                            <div class="card text-white bg-info">
                                <div class="card-body pb-0">
                                    <div class="font-weight-bold h5">{{ $settings6['chart_title'] }}</div>
                                    <div class="text-value">Ksh. {{ number_format($settings6['total_number']) }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>

                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings4['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings4['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped datatable datatable-User">
                                <thead>
                                <tr>
                                    @foreach($settings4['fields'] as $key => $value)
                                        @if($key == 'business')
                                            <th>
                                                Account
                                            </th>
                                        @else
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings4['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endif
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($settings4['data'] as $entry)
                                    <tr>
                                        @foreach($settings4['fields'] as $key => $value)
                                            <td>
                                                @if($value === '')
                                                    {{ $entry->{$key} }}
                                                @elseif(is_iterable($entry->{$key}))
                                                    @foreach($entry->{$key} as $subEentry)
                                                        <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                    @endforeach
                                                @else
                                                    {{ data_get($entry, $key . '.' . $value) }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($settings4['fields']) }}">{{ __('No entries found') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if(auth()->user()->isAdmin)
                            <div class="{{ $chart5->options['column_class'] }}">
                                <h3>{!! $chart5->options['chart_title'] !!}</h3>
                                {!! $chart5->renderHtml() !!}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    $('.datatable-User:not(.ajaxTable)').DataTable()
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
</script>
@if(auth()->user()->isAdmin)
    {!! $chart5->renderJs() !!}
@endif
@endsection
