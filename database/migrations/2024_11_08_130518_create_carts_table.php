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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_provider', 50)->nullable();
            $table->string('payment_method', 50)->nullable();
            
            $table->double('price_shipping', 8, 2)->default(0);
            $table->double('price_items', 8, 2)->default(0);
            $table->double('price_discount', 8, 2)->default(0);
            $table->double('price_insurance', 8, 2)->default(0);
            $table->double('price_fee', 8, 2)->default(0);
            $table->double('price_total', 8, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
