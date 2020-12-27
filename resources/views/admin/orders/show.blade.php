@extends('layouts.admin')
@section('content')
<style>
    .product{background:#fff;}
    .product:hover {background:#f2f2f2;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);}
    .product-img {border-radius: 0px 0px 0 0;max-height:180px;overflow: hidden;}
    .product-block{padding:15px;}
    .product-footer {background:#f4f4f4;border-top:1px solid #ccc;padding:10px 15px 15px 10px}
    .divider {border: 1px solid #ccc;}
    .title-links ul {margin-bottom:10px; margin-top:10px;}
</style>
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.order.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.status') }}
                        </th>
                        <td>
                            {{ $order->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <td>
                            {{ $order->customer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.total') }}
                        </th>
                        <td>
                            {{ $order->total}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.created_at') }}
                        </th>
                        <td>
                            {{ $order->created_at}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-12">
                    <div class="h5 mt-3">{{ trans('cruds.order.fields.order_items') }}</div>
                </div>
                @foreach($order->orderItems as $orderItem)
                    <div class="col-md-3">
                        <div class="product border w-100">
                            <div class="product-img">
                                <img src="{{$orderItem->product->photo[0]->preview}}" class="w-100 img-thumbnail">
                            </div>
                            <div class="product-block">
                                <h5>{{$orderItem->product->name}}</h5>
                                <h5 class="text-danger">Ksh {{$orderItem->product->price}}</h5>
                                @if($orderItem->size)
                                    <p>Size: <span class="ml-2 font-weight-bold">{{$orderItem->size}}</span></p>
                                @endif
                                @if($orderItem->size)
                                    <p>Color: <span class="ml-2 font-weight-bold">{{$orderItem->color}}</span></p>
                                @endif
                                @if($orderItem->options)
                                    <p>Options: <span class="ml-2 font-weight-bold">{{$orderItem->options}}</span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-group mt-3">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
