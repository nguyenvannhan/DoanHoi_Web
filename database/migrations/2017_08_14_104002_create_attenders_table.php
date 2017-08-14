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

            $table->string('activityId');
            $table->string('studentId', 8);
            $table->string('studentName');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('check')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['activityId', 'studentId']);
            $table->foreign('activityId')->references('id')->on('activities')->onDelete('cascade');
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
