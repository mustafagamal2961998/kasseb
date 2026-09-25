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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                   ->constrained('users')
                   ->cascadeOnDelete();
                   
            $table->foreignId('coupon_id')
                   ->nullable()
                   ->constrained('coupons')
                   ->nullOnDelete();  

            $table->foreignId('address_id')
                   ->constrained('addresses')
                   ->cascadeOnDelete();

            $table->string('number')->unique();    
            $table->integer('total');
            $table->enum('type',['user','trader']);
            $table->enum('payment_method',['cod','digital_wallet','bank_card'])->default('cod');
            $table->enum('status',['pending','packed','shipped','in_delivery','received','cancelled','refunded','completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
