<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('lost_founds', function (Blueprint $table) {
            if (!Schema::hasColumn('lost_founds', 'kategori')) {
                $table->enum('kategori', ['primer','sekunder','tersier'])
                      ->after('judul');
            }
        });
    }

    public function down()
    {
        Schema::table('lost_founds', function (Blueprint $table) {
            if (Schema::hasColumn('lost_founds', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }
};
