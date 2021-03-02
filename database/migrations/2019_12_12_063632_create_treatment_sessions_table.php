<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('num_session');
            $table->text('message');

            $table->unsignedBigInteger('treatment_id');
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('treatment_sessions');
    }
}
