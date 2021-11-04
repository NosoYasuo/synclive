<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWatchesTableAdd3columns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('watches', function (Blueprint $table) {
            $table->string('user_name')->nullable()->after('watch')->comment('ユーザーネーム');
        });
        Schema::table('watches', function (Blueprint $table) {
            $table->string('title')->nullable()->after('watch')->comment('タイトル');
        });
        Schema::table('watches', function (Blueprint $table) {
            $table->string('auther')->nullable()->after('watch')->comment('チャンネル名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('watches', function (Blueprint $table) {
            Schema::table('watches', function (Blueprint $table) {
            $table->dropColumn('user_name');
            });
            Schema::table('watches', function (Blueprint $table) {
            $table->dropColumn('title');
            });
            Schema::table('watches', function (Blueprint $table) {
            $table->dropColumn('auther');
            });
            
    }
}

