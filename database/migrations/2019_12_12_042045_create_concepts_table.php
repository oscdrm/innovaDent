<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('concept_surgery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('surgery_id');
            $table->unsignedBigInteger('concept_id');
            $table->timestamps();

            $table->unique(['surgery_id', 'concept_id']);

            $table->foreign('surgery_id')
                ->references('id')
                ->on('surgeries')
                ->onDelete('cascade');

            $table->foreign('concept_id')
                ->references('id')
                ->on('concepts')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concepts');
    }
}
