<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            // $table->id('lecturer_id');
            $table->string('lecturer_code')->primary();
            $table->timestamps();
            $table->string('lecturer_name');
            $table->softDeletes();

            // $table->foreignId('user_id')->nullable()->references('id')->on('users');
            // $table->foreignId('lecturer_code')->references('subject_id')->on('allocation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturers');
    }
}
