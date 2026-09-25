<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('Dashboard.Admin.index',compact('admins'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $admin = new Admin();
        
        return view('Dashboard.Admin.create',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $store = Admin::create($request->all());
        if($request->hasFile('avatar')){
            $store->addMedia($request->file('avatar'))
                  ->toMediaCollection('avatar');
        }else{
            $store->copyMedia(public_path('assets/media/dashboard/avatar.png'))->toMediaCollection('avatar');
        }
        return redirect()->route('dashboard.admins.index')->with('success','تم إضافة المسؤل بنجاح');
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
        $admin = Admin::with('media')->find($id);
        return view('Dashboard.Admin.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $update = Admin::find($id);
        $update->update([
                'full_name'=>$request->full_name,
                'username'=>$request->username,
                'password'=>Hash::make($request->password),
                'status'=>$request->status,
        ]);
        if($request->hasFile('avatar')){
            $update->clearMediaCollection('avatar');
            $update->addMedia($request->file('avatar'))
                  ->toMediaCollection('avatar');
        }
        return redirect()->route('dashboard.admins.index')->with('success','تم تعديل  بيانات المسؤل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Admin::find($id);
        $delete->delete();
        return redirect()->route('dashboard.admins.index')->with('success','تم حذف المسؤل بنجاح');
    }
}
