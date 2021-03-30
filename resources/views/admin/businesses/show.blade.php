@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.business.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.businesses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.id') }}
                        </th>
                        <td>
                            {{ $business->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.name') }}
                        </th>
                        <td>
                            {{ $business->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.tag') }}
                        </th>
                        <td>
                            {{ $business->tag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.contact') }}
                        </th>
                        <td>
                            {{ $business->contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.email') }}
                        </th>
                        <td>
                            {{ $business->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.industry') }}
                        </th>
                        <td>
                            {{ $business->industry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.description') }}
                        </th>
                        <td>
                            {{ $business->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.networth') }}
                        </th>
                        <td>
                            {{ $business->networth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.business.fields.balance') }}
                        </th>
                        <td>
                            {{ $business->balance }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.businesses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection