<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nis');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('password');
            $table->string('role');
            $table->unsignedInteger('jumlah_pelanggaran')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};

