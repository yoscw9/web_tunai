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
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');         
            $table->foreignId('menu_id')->nullable()->constrained('menus')->onDelete('cascade');         
            $table->foreignId('menu_promo_id')->nullable()->constrained('menu_promos')->onDelete('cascade');         
            $table->foreignId('package_menu_id')->nullable()->constrained('package_menus')->onDelete('cascade');         
            $table->foreignId('package_menu_primo_id')->nullable()->constrained('package_menu_primos')->onDelete('cascade');         
            $table->integer('jumlah');
            $table->integer('total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
