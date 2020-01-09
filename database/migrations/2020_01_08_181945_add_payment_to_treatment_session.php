<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentToTreatmentSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatment_sessions', function (Blueprint $table) {
            $table->float('payment')->nullable()->after('treatment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatment_sessions', function (Blueprint $table) {
            //
        });
    }
}
