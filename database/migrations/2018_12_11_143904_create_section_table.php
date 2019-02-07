<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('year');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('std_count')->default(0);
            $table->string('class_date');
            $table->integer('class_day');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->double('sec_lat');
            $table->double('sec_lon');
            $table->integer('check_button_status')->default(0);
            $table->integer('check_radius');
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
        Schema::dropIfExists('section', function (Blueprint $table) {
            $table->primary('id');
        });
    }
}
