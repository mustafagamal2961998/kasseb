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

                                    


        Schema::create('products', function (Blueprint $table) {
            $table->id();

              $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete();
            $table->foreignId('brand_id')
                  ->nullable()
                  ->constrained('brands')
                  ->nullOnDelete();

            $table->string('name');
            // $table->string('name_en');

            $table->string('slug')->unique();
            // $table->string('slug_en')->unique();


            $table->text('description')->nullable();
            // $table->text('description_en');

            $table->decimal('unit_price',10,2);
            $table->decimal('box_price',10,2)->nullable();
            $table->integer('discount_rate');

            $table->integer('unit_stock');
            $table->integer('box_stock')->nullable();
            
            $table->integer('minimum_stock');
            $table->integer('maximum_order')->nullable();

            
            // $table->enum('package_type',['one_unit','package'])->default('one_unit');
            
            $table->boolean('best_seller')->default(false);

            $table->enum('status',['active','archived'])->default('active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
