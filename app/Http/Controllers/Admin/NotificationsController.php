<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;

class NotificationsController extends Controller
{

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function delete($id)
    {
        Auth::user()->notifications()
            ->where('id', $id)->delete();

        return back()
            ->with('success', 'Notification deleted.');
    }
}
