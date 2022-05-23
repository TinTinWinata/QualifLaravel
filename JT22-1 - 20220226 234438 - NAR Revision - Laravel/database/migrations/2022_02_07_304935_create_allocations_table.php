<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->string('subject_code');
            $table->foreign('subject_code')->references('subject_code')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->string('classroom');
            $table->foreign('classroom')->references('classroom')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->string('lecturer_code');
            $table->foreign('lecturer_code')->references('lecturer_code')->on('lecturers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('allocations');
    }
}
