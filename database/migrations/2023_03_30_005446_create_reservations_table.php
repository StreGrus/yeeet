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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('package_list_id')->constrained('package_lists')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('reservation_date');
            $table->unsignedInteger('price');
            $table->integer('quantity');
            $table->unsignedDecimal('dicount')->nullable()->max(100);
            $table->string('transfer_photo');
            $table->enum('status_reservation', ['pesan', 'dibayar', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
