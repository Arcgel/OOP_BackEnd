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
        Schema::create('archive_products', function (Blueprint $table) {
            $table->id('Itemcode');
            $table->string('Item_Name');
            $table->string('Description');
            $table->decimal('Unit_Price');
            $table->decimal('Quantity');
            $table->string('Image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_products');
    }
};
