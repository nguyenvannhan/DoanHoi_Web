<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
             $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->string('leader', 8);
            $table->date('start_date');
            $table->date('end_date');
            $table->date('start_regis_date');
            $table->date('end_regis_date');
            $table->text('content')->nullable();
            $table->unsignedInteger('school_year_id');
            $table->unsignedTinyInteger('conduct_mark');
            $table->unsignedTinyInteger('social_mark');
            $table->unsignedTinyInteger('activity_level');
            $table->unsignedInteger('class_id')->nullable();
            $table->string('trailer')->nullable();
            $table->unsignedInteger('max_regis_number')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('leader')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
