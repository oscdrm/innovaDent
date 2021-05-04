<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('concept_id')->nullable();
            $table->foreign('concept_id')->references('id')->on('concepts')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('doctor_id')->boolean();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->dateTime('cashed_on', 0)->nullable();
            $table->float('amount');

            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('other_patient')->nullable(); 
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
        Schema::dropIfExists('consults');
    }
}
