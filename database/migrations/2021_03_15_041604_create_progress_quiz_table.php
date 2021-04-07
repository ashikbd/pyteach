<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_quiz', function (Blueprint $table) {
            $table->integer('student_id');
            $table->integer('quiz_id');
            $table->string('answers');
            $table->decimal('point',4,2);
            $table->primary(['student_id','quiz_id']);
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
        Schema::dropIfExists('progress_quiz');
    }
}
