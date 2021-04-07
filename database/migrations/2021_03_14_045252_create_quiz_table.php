<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->integer('topic_id');
            $table->tinyInteger('type')->comment('1=write answer, 2=single choice, 3=multiple choice')->default(1);
            $table->integer('position')->default(0);
            $table->tinyInteger('status')->comment('0=disabled,1=enabled')->default(0);
            $table->integer('point');
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
        Schema::dropIfExists('quiz');
    }
}
