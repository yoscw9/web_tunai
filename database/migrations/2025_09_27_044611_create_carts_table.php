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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_token');
            $table->string('no_meja');
            $table->foreignId('menu_id')->nullable()->constrained('menus')->onDelete('cascade');
            $table->foreignId('menu_promo_id')->nullable()->constrained('menu_promos')->onDelete('cascade');
            $table->foreignId('package_menu_id')->nullable()->constrained('package_menus')->onDelete('cascade');
            $table->foreignId('package_menu_promo_id')->nullable()->constrained('package_menu_promos')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
