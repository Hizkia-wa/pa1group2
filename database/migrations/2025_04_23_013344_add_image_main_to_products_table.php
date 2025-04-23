<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageMainToProductsTable extends Migration
{
    public function up(): void
    {
        Schema::table('Products', function (Blueprint $table) {
            $table->string('ImageMain')->nullable()->after('Description');
        });
    }

    public function down(): void
    {
        Schema::table('Products', function (Blueprint $table) {
            $table->dropColumn('ImageMain');
        });
    }
}