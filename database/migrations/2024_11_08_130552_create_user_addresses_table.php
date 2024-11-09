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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50);
            $table->enum('category', ['HOME', 'KOST', 'OFFICE', 'APARTMENT', 'OTHER']);
            $table->string('full_address', 200);
            $table->string('receiver_name', 50);
            $table->string('receiver_phone', 20);
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->string('postal_code', 10);
            $table->string('notes', 45)->nullable();
            $table->boolean('is_primary')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
