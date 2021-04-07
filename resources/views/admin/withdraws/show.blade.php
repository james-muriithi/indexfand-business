@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.withdraw.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.withdraws.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.withdraw.fields.id') }}
                        </th>
                        <td>
                            {{ $withdraw->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdraw.fields.business') }}
                        </th>
                        <td>
                            {{ $withdraw->business->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdraw.fields.phone') }}
                        </th>
                        <td>
                            {{ $withdraw->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdraw.fields.amount') }}
                        </th>
                        <td>
                            {{ $withdraw->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdraw.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $withdraw->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdraw.fields.created_at') }}
                        </th>
                        <td>
                            {{ $withdraw->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.withdraws.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
