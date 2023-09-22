<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notificationList(){
        $user = Auth::user();
        $notifications = $user->notifications;
        return view('notification.notification_list',compact('notifications'));
    }

    public function markNotificationAsRead(Request $request){
        $user = Auth::user();
        $notification = $user->notifications->where('id', $request->id)->first();
        $notification->markAsRead();
        $notification_count = count($user->unreadNotifications);
        return $notification_count;
    }

    public function markNotificationAsUnRead(Request $request){
        $user = Auth::user();
        $notification = $user->notifications->where('id', $request->id)->first();
        $notification->markAsUnread();
        $notification_count = count($user->unreadNotifications);
        return $notification_count;
    }
}
