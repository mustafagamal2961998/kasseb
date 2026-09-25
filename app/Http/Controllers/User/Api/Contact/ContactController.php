<?php

namespace App\Http\Controllers\User\Api\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Contact\ContactRequest;
use App\Http\Resources\User\Contact\ContactResource;
use App\Models\About;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = User::with('contacts')->find(Auth::guard('sanctum')->id());
        return response()->json([
            'data'=>ContactResource::collection($contacts->contacts),
            'statusCode'=>200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $store = Contact::create($request->all());
        return response()->json([
            'message'=>'تم إرسال رسالتك بنجاح',
            'statusCode'=>200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, string $id)
    {
        $update = About::find($id);
        $update->update($request->all());
        return response()->json([
            'message'=>'تم تعديل رسالتك بنجاح',
            'statusCode'=>200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = About::find($id);
        $delete->delete();
        return response()->json([
            'message'=>'تم حذف رسالتك بنجاح',
            'statusCode'=>200,
        ]);
    }
}
