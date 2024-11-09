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
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 100);
            $table->enum('status', ['PENDING', 'INPROCESS', 'COMPLETED', 'CANCELED', 'FAILED', 'TROUBLE', 'ONHOLD']);
            
            $table->string('shipping_provider', 50);
            $table->string('shipping_receipt_number', 50);
            $table->enum('shipping_status', ['INPROCESS', 'WAITING', 'SHIPPED', 'DELIVERED', 'RETURNED', 'LOST', 'DAMAGED']);

            $table->string('payment_method', 50);
            $table->string('payment_receipt_number', 50);
            $table->enum('payment_status', ['PENDING', 'WAITING', 'PAID', 'FAILED', 'REFUNDED', 'CANCELED']);

            $table->double('price_shipping', 8, 2)->default(0);
            $table->double('price_items', 8, 2)->default(0);
            $table->double('price_discount', 8, 2)->default(0);
            $table->double('price_insurance', 8, 2)->default(0);
            $table->double('price_fee', 8, 2)->default(0);
            $table->double('price_total', 8, 2)->default(0);
            
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_headers');
    }
};
