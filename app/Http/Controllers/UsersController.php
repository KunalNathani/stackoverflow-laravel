<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('users.notifications', compact(['notifications']));
    }

    public function markAsRead($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);
        $notification->markAsRead();
        return redirect()->back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
