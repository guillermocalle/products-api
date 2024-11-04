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
      Schema::table('product_supplier', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['supplier_id']);
            
            $table->unsignedBigInteger('product_id')->change();
            $table->unsignedBigInteger('supplier_id')->change();
            
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('product_supplier', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['supplier_id']);
            
            $table->foreignId('product_id')->constrained('products')->change();
            $table->foreignId('supplier_id')->constrained('suppliers')->change();
        });
    }
};
