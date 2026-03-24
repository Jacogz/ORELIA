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
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_price');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('piece_id')->constrained('pieces')->cascadeOnDelete();
            // Foreign keys will be added in Jewelry project
            // when Order and Piece tables exist
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};