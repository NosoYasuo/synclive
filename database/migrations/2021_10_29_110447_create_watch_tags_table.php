<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Watch_id');
           $table->unsignedBigInteger('tag_id');

            $table->timestamps();

            $table->foreign('Watch_id')->references('id')->on('watches')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watch_tags');
    }
}
