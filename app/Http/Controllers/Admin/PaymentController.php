<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->isAdmin){
            $payments = Payment::all();
        }else{
            $businesses = Auth::user()->userBusinesses()->pluck('id');
            $payments = Payment::whereHas('business', function ($query) use ($businesses){
                $query->whereIn('id', $businesses);
            })
                ->latest()
                ->get();
        }

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businesses = Auth::user()->userBusinesses()->pluck('id');
        $notAllowed = !Auth::user()->isAdmin && !Payment::whereHas('business', function ($query) use ($businesses){
                $query->whereIn('id', $businesses);
            })->find($payment->id);
        abort_if($notAllowed, Response::HTTP_NOT_FOUND, '404 Not Found');

        return view('admin.payments.show', compact('payment'));
    }
}
