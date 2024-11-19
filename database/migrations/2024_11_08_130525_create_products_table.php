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
            $table->string('sku', 50)->unique();
            $table->string('name', 100);
            $table->string('image', 100)->nullable();
            $table->integer('stock');
            $table->integer('minimum_buy');
            $table->integer('weight');
            $table->double('price', 8, 2);
            $table->text('description')->nullable();
            $table->integer('total_sold')->default(0);
            $table->double('rating', 8, 2)->default(5);

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
