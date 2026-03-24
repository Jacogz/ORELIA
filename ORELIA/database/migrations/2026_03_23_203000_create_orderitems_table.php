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
        if (!Schema::hasTable('orderitems')) {
            Schema::create('orderitems', function (Blueprint $table) {
                $table->id();
                $table->integer('unit_price');
                $table->integer('quantity');
                $table->integer('subtotal');
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('piece_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};
