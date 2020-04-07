<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_tag', function (Blueprint $table) {
            $table->id();
            $table->integer('resume_id')->unsigned();
            // $table->foreign('resume_id')->references('id')->on('resumes');

            $table->integer('tag_id')->unsigned();
            // $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_tag');
    }
}
