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
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnDelete();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            $table->string('product_name_ar');      
            $table->string('product_name_en');

            $table->integer('quantity')->default(1);
            $table->integer('price');
            $table->integer('discount_rate')->default(0);
            $table->enum('need_type',['unit','box'])->default('unit');
            $table->integer('total'); 
            $table->enum('status',['pending','packed','shipped','in_delivery','received','cancelled','refund','refunded','completed'])->default('pending');

           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};
