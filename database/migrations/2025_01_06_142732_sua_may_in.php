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
        Schema::create('sua_may_in', function (Blueprint $table) {
            $table->id();
            $table->integer('id_may_in_sua');
            $table->integer('kho');
            $table->date('ngay_bao_hong');
            $table->date('thay_bao_lua')->nullable();
            $table->date('thay_rulo')->nullable();
            $table->date('bao_tri')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sua_may_in');
    }
};
