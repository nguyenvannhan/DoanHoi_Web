<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentes', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';

            $table->string('mssv',8);
            $table->string('student_name', 100)->unique();
            $table->integer('classId')->unsigned()->nullable();
            $table->integer('scienceId')->unsigned();
            $table->boolean('is_female')->default(true);
            $table->boolean('is_doanvien')->default(true);
            $table->boolean('is_dangvien')->default(false);
            $table->string('hometown', 200)->nullable();
            $table->string('number_phone', 20)->nullable()->unique();
            $table->date('birthday', 20)->nullable();
            $table->string('email', 200)->unique()->nullable();
            $table->integer('diem_ctxh')->unsigned()->nullable();
            $table->integer('status')->unsigned()->default(0);
            $table->boolean('is_it_student')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->primary('mssv');
            $table->foreign('scienceId')->references('id')->on('sciences')->onDelete('cascade');
            $table->foreign('classId')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentes');
    }
}
