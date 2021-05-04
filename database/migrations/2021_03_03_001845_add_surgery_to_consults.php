<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurgeryToConsults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consults', function (Blueprint $table) {
            $table->unsignedBigInteger('surgery_id')->default(1);
            $table->foreign('surgery_id')->references('id')->on('surgeries')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consults', function (Blueprint $table) {
            //
        });
    }
}
