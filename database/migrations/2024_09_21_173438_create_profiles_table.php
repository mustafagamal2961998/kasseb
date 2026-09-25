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
        Schema::create('profiles', function (Blueprint $table) {
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            $table->string('full_name');
            // $table->string('email')->unique()->nullable();
            // $table->string('mobile'x)->unique();
            // $table->string('address');
            // $table->enum('work_type',['super_market','restaurant','cafee','other'])->nullable();
            $table->timestamps();
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
