<?php

namespace App\Http\Controllers\Dashboard\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('Dashboard.Contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $update = Contact::find($id);
        $update->update([
            'status'=>'readed',
        ]);
        return redirect()->route('dashboard.contacts.index')->with('success','تم تميز الرسالة كمقروءه');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Contact::find($id);
        $delete->delete();
        return redirect()->route('dashboard.contacts.index')->with('success','تم حذف الرسالة بنجاح');
    }
}
