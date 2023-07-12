<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getAll()
    {
        $notifications = Notification::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $notifications,
        ]);
    }

    public function getUnread()
    {
        $notifications = Notification::where('is_read', 0)->latest()->limit(5)->get();

        return response()->json([
            'success' => true,
            'data' => $notifications,
        ]);
    }

    public function readAll()
    {
        Notification::where('is_read', 0)->update([
            'is_read' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications has been read.',
        ]);
    }

    public function unreadAll()
    {
        Notification::where('is_read', 1)->update([
            'is_read' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications has been unread.',
        ]);
    }

    public function readOne(string $id)
    {
        $notification = Notification::find($id);
        $notification->is_read = 1;
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification has been read.',
        ]);
    }

    public function unreadOne(string $id)
    {
        $notification = Notification::find($id);
        $notification->is_read = 0;
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification has been unread.',
        ]);
    }

    public function deleteAll()
    {
        Notification::where('is_read', 0)->orWhere('is_read', 1)->delete();

        return response()->json([
            'success' => true,
            'message' => 'All notifications has been deleted',
        ]);
    }

    public function deleteOne(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found',
            ]);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification has been deleted',
        ]);
    }
}
