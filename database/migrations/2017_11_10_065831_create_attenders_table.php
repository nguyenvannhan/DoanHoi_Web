<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attenders', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';

            $table->unsignedInteger('activity_id');
            $table->string('student_id', 8);
            $table->timestamp('time_id')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('check')->default(0);
            $table->unsignedInteger('conduct_mark')->default(0);
            $table->unsignedInteger('social_mark')->default(0);
            $table->unsignedInteger('minus_conduct_mark')->default(0);
            $table->unsignedInteger('minus_social_mark')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['activity_id', 'student_id']);
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attenders');
    }
}
