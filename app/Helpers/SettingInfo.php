<?php
namespace App\Helpers;

use App\Models\Setting;

class SettingInfo{

    public static function setting (){
        $setting = Setting::query()->first();
        return $setting;
    }
    
}