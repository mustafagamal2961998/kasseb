<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name_ar');    
            $table->string('website_name_en');    
            $table->string('website_bio_ar');    
            $table->string('website_bio_en');    
            $table->enum('delivery_status',[0,1])->default(1);
            $table->integer('refund_day')->default(1);
            $table->integer('minimum_order_price')->default(0);
            $table->integer('shipping_amount')->default(0);
            // $table->string('main_bg_color')->default('195deg, #EC407A 0%, #D81B60 100%');
            // $table->string('main_bg_color_on_hover')->default('195deg, #534534 0%, #f35345 100%');
            // $table->string('main_color_text')->default('#ffffff');
            // $table->string('main_color_text_on_hover')->default('#222222');
            // $table->string('main_color_text_without_bg')->default('#222222');
            // $table->string('main_link_color_text')->default('#253D4E');
            // $table->string('main_link_color_text_on_hover')->default('#1c93e7');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
