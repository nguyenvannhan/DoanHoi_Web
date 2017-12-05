<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';

            $table->string('id',8);
            $table->string('name', 100);
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('science_id');
            $table->boolean('is_female')->default(true);
            $table->boolean('is_cyu')->default(true);
            $table->boolean('is_partisan')->default(false);
            $table->string('hometown', 200)->nullable();
            $table->string('number_phone', 20)->nullable()->unique();
            $table->date('birthday', 20)->nullable();
            $table->string('email', 200)->unique()->nullable();
            $table->unsignedInteger('social_mark')->default(0);
            $table->unsignedInteger('status')->default(1);
            $table->boolean('is_it_student')->default(true);
            $table->unsignedInteger('faculty_id')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('science_id')->references('id')->on('sciences')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
