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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            $table->decimal('base_unit_price',10,2);                      
            $table->decimal('offer_unit_price',10,2); 
            $table->decimal('base_box_price',10,2)->nullable();                      
            $table->decimal('offer_box_price',10,2)->nullable(); 
            $table->timestamp('start_offer_date')->nullable();
            $table->timestamp('end_offer_date')->nullable();

            $table->text('description')->nullable();
            // $table->text('description_en')->nullable();

            $table->enum('status',['active','archived'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
