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
      Schema::table('products', function (Blueprint $table) {
        $table->string('name')->unique()->change();

        $table->decimal('price', 8, 2)->change();

         $table->dropForeign(['category_id']);

        $table->unsignedBigInteger('category_id')->change();
        $table->foreign('category_id')->references('id')->on('categories');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('products', function (Blueprint $table) {
        $table->string('name')->change();

        $table->decimal('price', 10, 2)->change();

        $table->dropForeign(['category_id']);
        $table->foreignId('category_id')->constrained('categories')->change();
      });
    }
};
