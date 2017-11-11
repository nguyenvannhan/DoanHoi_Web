<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTale extends Migration
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

            $table->string('id');
            $table->string('activityName');
            $table->string('leader', 8);
            $table->date('startDate');
            $table->date('endDate');
            $table->date('startRegistrationDate');
            $table->date('endRegistrationDate');
            $table->text('content')->nullable();
            $table->unsignedInteger('schoolYearId');
            $table->unsignedTinyInteger('conductMark');
            $table->unsignedTinyInteger('socialMark');
            $table->unsignedTinyInteger('activityLevel');
            $table->unsignedInteger('classId')->nullable();
            $table->string('trailer')->nullable();
            $table->unsignedInteger('maxRegisNumber')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('leader')->references('mssv')->on('studentes')->onDelete('cascade');
            $table->foreign('classId')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('schoolYearId')->references('id')->on('school_yeares')->onDelete('cascade');
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
