<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyuClassCommitteesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('cyu_class_committee', function (Blueprint $table) {
          $table->charset = 'utf8';
          $table->collation = 'utf8_unicode_ci';
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->unsignedInteger('class_id');
          $table->string('student_id', 8);
          $table->unsignedInteger('position');
          $table->boolean('is_young_union');

          $table->softDeletes();
          $table->timestamps();

          $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
          $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cyu_class_committee');
    }
}
