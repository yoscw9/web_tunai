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
        Schema::create('package_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->enum('status', ['Aktif', 'Non-aktif'])->default('Aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_menus');
    }
};
