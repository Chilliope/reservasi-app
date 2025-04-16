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
        Schema::create('orders', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', [
                'male',
                'female'
            ]);
            $table->string('number')->unique();
            $table->string('type');
            $table->integer('price');
            $table->date('order_date');
            $table->integer('duration');
            $table->boolean('is_breakfast');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
