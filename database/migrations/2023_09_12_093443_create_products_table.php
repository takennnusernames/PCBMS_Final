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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->string('code');
            $table->string('name');
            $table->longText('description');
            $table->longText('image');
            $table->enum('unit', ['pack', 'piece', 'bottle', 'box']);
            $table->integer('qty')->default(0);
            $table->integer('srp');
            $table->integer('price');
            $table->dateTime('restock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
