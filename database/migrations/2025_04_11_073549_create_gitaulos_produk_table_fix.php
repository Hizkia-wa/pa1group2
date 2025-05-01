<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGitaUlosProdukTableFix extends Migration
{
    public function up(): void
    {
        // Tabel Admins
        Schema::create('Admins', function (Blueprint $table) {
            $table->id();
            $table->string('AdminName', 255);
            $table->string('Email', 255)->unique();
            $table->string('Password', 100);
            $table->timestamps();
        });

        // Tabel Customers
        Schema::create('Customers', function (Blueprint $table) {
            $table->id();
            $table->string('CustomerName', 255);
            $table->string('Email', 255)->unique();
            $table->string('Password', 255);
            $table->text('Address')->nullable();
            $table->date('Birthday')->nullable();
            $table->timestamps();
            
        });

        // Tabel Products
        Schema::create('Products', function (Blueprint $table) {
            $table->id();
            $table->string('ProductName', 255);
            $table->integer('Quantity');
            $table->decimal('Price', 10, 2);
            $table->string('Category');
            $table->text('Description')->nullable();
            $table->longText('Images')->nullable(); // Menyimpan multiple image (format JSON, dsb)
            $table->boolean('is_best_seller')->default(false); // Produk terlaris atau tidak
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabel Carts
        Schema::create('Carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Product_id')->constrained('products')->onDelete('cascade');
            $table->integer('Quantity');
            $table->timestamps();
        });

        // Tabel Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProductId');
            $table->string('CustomerName');
            $table->string('Email');
            $table->string('Phone');
            $table->string('City');
            $table->string('District');
            $table->string('Address');
            $table->string('PostalCode');
            $table->string('Size');
            $table->integer('Quantity');
            $table->enum('OrderStatus', ['Diproses', 'Selesai', 'Batal'])->default('Diproses');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('ProductId')->references('id')->on('products')->onDelete('cascade');
        });
        

        // Tabel Reviews
        Schema::create('Reviews', function (Blueprint $table) {
            $table->id();
            $table->string('ReviewerName', 255);
            $table->unsignedTinyInteger('Rating');
            $table->longText('Picture')->nullable(); // Bisa simpan multiple gambar
            $table->text('Comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('otp');
            $table->timestamp('created_at')->nullable();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('Reviews');
        Schema::dropIfExists('Orders');
        Schema::dropIfExists('Carts');
        Schema::dropIfExists('Products');
        Schema::dropIfExists('Customers');
        Schema::dropIfExists('Admins');
        Schema::dropIfExists('password_resets');
    }
}
