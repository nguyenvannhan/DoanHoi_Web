<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyuFacultyCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cyu_faculty_members', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';

            $table->unsignedInteger ('committee_id');
            $table->string('student_id',8);
            $table->unsignedInteger('position');
            $table->boolean('is_young_union');

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['committee_id','student_id']);
            $table->foreign('committee_id')->references('id')->on('cyu_faculty_committee')->onDelete('cascade');
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
        Schema::dropIfExists('cyu_class_committee');
    }
}
