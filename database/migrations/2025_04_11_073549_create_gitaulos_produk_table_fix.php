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
            $table->string('Role')->default('customer');
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
            $table->string('ImageMain')->nullable();
            $table->longText('Images')->nullable();
            $table->boolean('IsBestSeller')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabel Carts
        Schema::create('Carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserId');
            $table->foreign('UserId')->references('id')->on('Customers')->onDelete('cascade');
            $table->foreignId('ProductId')->constrained('Products')->onDelete('cascade');
            $table->string('Size');
            $table->integer('Quantity');
            $table->timestamps();
        });

        // Tabel Orders
        Schema::create('Orders', function (Blueprint $table) {
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

            $table->foreign('ProductId')->references('id')->on('Products')->onDelete('cascade');
        });

        // Tabel Reviews
        Schema::create('Reviews', function (Blueprint $table) {
            $table->id();
            $table->string('ReviewerName', 255);
            $table->unsignedTinyInteger('Rating');
            $table->longText('Picture')->nullable();
            $table->text('Comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabel password_resets
        Schema::create('PasswordResets', function (Blueprint $table) {
            $table->string('Email')->index();
            $table->string('Otp');
            $table->timestamp('CreatedAt')->nullable();
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
        Schema::dropIfExists('PasswordResets');
    }
}
