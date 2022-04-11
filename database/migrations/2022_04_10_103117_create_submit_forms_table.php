<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_forms', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');

            $table->integer('job_id')->unsigned()->index();
            $table->foreign('job_id')->references('id')->on('jobs')->constrained()->onDelete('cascade');

            $table->string('experience');
            $table->string('status')->default('In progress');
            $table->timestamp('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submit_forms');
    }
}
