<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();
        return $this->successResponse(
            new NotificationResource($notification),
            'Notification retrieved successfully'
        );
    }

    public function listByUserID($userID)
    {
        $notifications = Notification::where('to_user_id', $userID)->where('is_read', false)->get();
        return $this->successResponse(
            new NotificationCollection($notifications),
            'Notifications retrieved successfully'
        );
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return response()->json($notification);
    }

    public function store(Request $request)
    {
        $notification = Notification::create($request->all());
        return response()->json($notification, 201);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update($request->all());
        return response()->json($notification, 200);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(null, 204);
    }
}