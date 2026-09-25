<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);  

        $admin = Admin::create([
            'full_name'=>'مصطفي جمال',
            'username'=>'admin',
            'password'=>Hash::make('123123123'),
        ]);
        $admin->copyMedia(public_path('assets/media/dashboard/avatar.png'))->toMediaCollection('admin');

        About::create([
            'content_ar'=>'من نحن',
            'content_en'=>'about us',
        ]);

        $setting = Setting::create([
            'website_name_ar'=>'تسويق',
            'website_name_en'=>'Ecommerce',
            'website_bio_ar'=>'عن موقع تسويق',
            'website_bio_en'=>'About Ecommerce Website',
            'delivery_status'=>'1',
            'refund_day'=>14,
            'minimum_order_price'=>0,
        ]);
        $setting->copyMedia(public_path('assets/media/dashboard/avatar.png'))->toMediaCollection('logo');
    }
}
