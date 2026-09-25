<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::query()->first();
        return view('Dashboard.Setting.index',compact('setting'));
    }

    public function update(SettingRequest $request,$id){

        $update = Setting::find($id);
        $update->update($request->all());
        if($request->hasFile('logo')){
            $update->clearMediaCollection('logo');
                $update->addMedia($request->file('logo'))
                       ->toMediaCollection('logo');
            
        }

        return redirect()->route('dashboard.settings.index')->with('success','تم تعديل الاعدادات بنجاح');
    }
}
