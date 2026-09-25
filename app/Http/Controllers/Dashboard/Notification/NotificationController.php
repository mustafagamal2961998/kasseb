<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Events\SendNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Notification\NotificationRequest;
use App\Models\Notification;
use Exception;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::latest()->paginate(20);
        return view('Dashboard.Notification.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.Notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationRequest $request)
    {
       try {
            // حفظ الـ Notification في الداتابيز
            $notification = Notification::create([
                'message' => $request->message
            ]);
            
            $imageUrl = null;
            
            // رفع الصورة لو موجودة
            if ($request->hasFile('image')) {
                $media = $notification->addMedia($request->file('image'))
                    ->toMediaCollection('notification');
                
                // الحصول على رابط الصورة
                $imageUrl = $media->getUrl();
            }
            
            // تجهيز البيانات للإرسال
            $eventData = [
                'id' => $notification->id,
                'message' => $notification->message,
                'image' => $imageUrl,
                'created_at' => $notification->created_at->toDateTimeString()
            ];
            
            // إطلاق الـ Event
            event(new SendNotificationEvent($eventData));
            return redirect()->route('dashboard.notifications.index')->with('success','تم حفظ وإرسال الاشعار بنجاح');
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send notification',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotificationRequest $request, string $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Notification::find($id);
        $delete->clearMediaCollection('notification');
        $delete->delete();
        return redirect()->route('dashboard.notifications.index')->with('success','تم حذف الاشعار بنجاح');
    }
}
