<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Models\Business;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BusinessesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->isAdmin){
            $businesses = Business::all();
        }else{
            $businesses = Auth::user()->userBusinesses;
        }

        return view('admin.businesses.index', compact('businesses'));
    }

    public function edit(Business $business)
    {
        abort_if(Gate::denies('business_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notAllowed = !Auth::user()->isAdmin && !Auth::user()->userBusinesses()->find($business->id);
        abort_if($notAllowed, Response::HTTP_NOT_FOUND, '404 Not Found');

        return view('admin.businesses.edit', compact('business'));
    }

    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $business->update($request->all());

        return redirect()->route('admin.businesses.index');
    }

    public function show(Business $business)
    {
        abort_if(Gate::denies('business_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notAllowed = !Auth::user()->isAdmin && !Auth::user()->userBusinesses()->find($business->id);
        abort_if($notAllowed, Response::HTTP_NOT_FOUND, '404 Not Found');

        return view('admin.businesses.show', compact('business'));
    }

    public function destroy(Business $business)
    {
        abort_if(Gate::denies('business_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $business->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessRequest $request)
    {
        Business::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
