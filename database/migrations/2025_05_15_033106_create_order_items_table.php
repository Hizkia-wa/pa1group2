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
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('OrderId')->constrained('orders')->onDelete('cascade');
    $table->foreignId('ProductId')->constrained('products')->onDelete('cascade');
    $table->string('Size');
    $table->integer('Quantity');
    $table->decimal('Price', 12, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
