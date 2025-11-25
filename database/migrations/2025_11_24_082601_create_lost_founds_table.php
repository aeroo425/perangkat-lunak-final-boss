<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lost_founds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('lokasi');
            $table->date('tanggal');
            $table->enum('status', ['hilang', 'ditemukan']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lost_founds');
    }
};
