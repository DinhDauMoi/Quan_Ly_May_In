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
        Schema::create('sua_muc_in', function (Blueprint $table) {
            $table->id();
            $table->integer('id_muc_in_sua');
            $table->integer('kho');
            $table->date('ngay_bom_muc');
            $table->tinyInteger('tinh_trang_muc');
            $table->date('thay_drum')->nullable();
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
        Schema::dropIfExists('sua_muc_in');
    }
};
