<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyShopRequest;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shops = Shop::with(['user', 'created_by'])->get();

        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        abort_if(Gate::denies('shop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->getIsAdminAttribute()){
            $users = User::all()->except(1)->pluck('name', 'user_id')->prepend(trans('global.pleaseSelect'), '');

            return view('admin.shops.create', compact('users'));
        }
        return view('admin.shops.create');
    }

    public function store(StoreShopRequest $request)
    {
        if (!$request->get('user_id')){
            $request->request->add(['user_id'=> Auth::user()->user_id]);
        }
        $shop = Shop::create($request->all());

        if ($request->input('photo', false)) {
            $shop->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $shop->id]);
        }

        return redirect()->route('admin.shops.index');
    }

    public function edit(Shop $shop)
    {
        abort_if(Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shop->load('user');

        return view('admin.shops.edit', compact('users', 'shop'));
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        if (!$request->get('user_id')){
            $request->request->add(['user_id'=> Auth::user()->user_id]);
        }

        $shop->update($request->all());

        if ($request->input('photo', false)) {
            if (!$shop->photo || $request->input('photo') !== $shop->photo->file_name) {
                if ($shop->photo) {
                    $shop->photo->delete();
                }

                $shop->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($shop->photo) {
            $shop->photo->delete();
        }

        return redirect()->route('admin.shops.index');
    }

    public function show(Shop $shop)
    {
        abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->load('user');

        return view('admin.shops.show', compact('shop'));
    }

    public function destroy(Shop $shop)
    {
        abort_if(Gate::denies('shop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->delete();

        return back();
    }

    public function massDestroy(MassDestroyShopRequest $request)
    {
        Shop::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('shop_create') && Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Shop();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
