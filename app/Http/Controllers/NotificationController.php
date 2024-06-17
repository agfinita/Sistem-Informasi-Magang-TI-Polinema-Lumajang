<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        $user = Auth::user();
    foreach ($user->notifications as $notification) {
        $notification->update(['read' => true]);
    }

    return redirect()->back();
    }
}
