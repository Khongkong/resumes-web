<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ResumeType;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            // $table->id();
            $table->id();
            $table->string('title')->comment('Title of resume');
            // $table->string('job')
            $table->text('content')->comment('Content of resume');
            $table->smallInteger('type')
                ->default(ResumeType::Mandarin)->comment('Type of resume');
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
        Schema::dropIfExists('resumes');
    }
}
