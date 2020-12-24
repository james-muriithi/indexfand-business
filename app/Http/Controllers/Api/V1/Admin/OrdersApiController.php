<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderResource(Order::with(['cutomer'])->get());
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderResource($order->load(['customer']));
    }

    public function store(StoreOrderRequest $request, Order $order)
    {
        $cust = $request->get('customer');

        $cust['mobile'] = preg_replace('/^(0|254)/', '+254', $cust['mobile']);

        $customer = Customer::updateOrCreate(
            ['email'=> $cust['email']],
            $cust
        );

        $total = 0;

        $order = Order::create(['customer_id' => $customer->id]);

        $orderItems = $request->get('products');

        foreach ($orderItems as $orderItem) {
            $product = Product::find($orderItem['product_id']);
            $orderItem['order_id'] = $order->id;
            OrderItem::create($orderItem);
            $total += floatval($product->price);
        }

        $order->update(['total' => $total]);

        return (new OrderResource($order->load(['customer','orderItems'])))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
