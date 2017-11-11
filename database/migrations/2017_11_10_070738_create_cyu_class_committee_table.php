<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyuClassCommitteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cyu_class_committee', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->engine = 'InnoDB';

            $table->integer ('id_bch_khoa')->unsigned();
            $table->string('mssv_student',8);
            $table->integer('position')->unsigned();
            $table->integer('is_cbdoan')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['id_bch_khoa','mssv_student']);
            $table->foreign('id_bch_khoa')->references('id')->on('bch_khoa')->onDelete('cascade');
            $table->foreign('mssv_student')->references('mssv')->on('studentes')->onDelete('cascade');
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
