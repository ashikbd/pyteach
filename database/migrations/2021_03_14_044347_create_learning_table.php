<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('topic_id');
            $table->longText('content');
            $table->integer('position')->default(0);
            $table->tinyInteger('status')->comment('0=disabled,1=enabled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning');
    }
}
