<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWithdrawRequest;
use App\Models\Business;
use App\Models\Withdraw;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WithdrawController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('withdraw_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $withdraws = Withdraw::with(['business'])->get();

        return view('admin.withdraws.index', compact('withdraws'));
    }

    public function create()
    {
        abort_if(Gate::denies('withdraw_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businesses = Auth::user()->userBusinesses()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');;

        return view('admin.withdraws.create', compact('businesses'));
    }

    public function store(StoreWithdrawRequest $request)
    {
        $withdraw = Withdraw::create($request->all());

        return redirect()->route('admin.withdraws.index');
    }

    public function show(Withdraw $withdraw)
    {
        abort_if(Gate::denies('withdraw_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $withdraw->load('business');

        return view('admin.withdraws.show', compact('withdraw'));
    }
}
