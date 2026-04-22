<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tahun_ajaran', function (Blueprint $table) {
            $table->boolean('is_active')->default(false)->after('kuota');
        });
    }

    public function down()
    {
        Schema::table('tahun_ajaran', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }

};
