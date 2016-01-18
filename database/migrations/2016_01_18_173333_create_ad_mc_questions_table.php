<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdMcQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_mc_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question', 140);
            $table->enum('type', array_keys(config('base.mc_question_types')));
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
        Schema::drop('ad_mc_questions');
    }
}
