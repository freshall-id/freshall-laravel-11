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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained();
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });

        Schema::table('transaction_headers', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('user_address_id')->constrained();
            $table->foreignId('voucher_id')->nullable()->constrained();
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->foreignId('transaction_header_id')->constrained();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('product_category_id')->nullable()->constrained();
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('voucher_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['cart_id']); 
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['cart_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('transaction_headers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_address_id']);
            $table->dropForeign(['voucher_id']);
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['transaction_header_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
        });
    }
};
