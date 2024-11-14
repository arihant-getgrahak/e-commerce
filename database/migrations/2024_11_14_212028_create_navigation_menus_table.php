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
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascade('delete');
            $table->foreignId('navigation_id')->constrained('navigations')->cascade('delete');
            $table->string('name');
            $table->string('link');
            $table->string('parent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_menus');
    }
};
