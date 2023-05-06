<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period', function (Blueprint $table) {
            $table->increments('idPeriod')->index();
            $table->string('numberPeriod');
            $table->string('isSold');
            $table->string('idGame');
            $table->string('priceTermPeriod');
            $table->string('priceSpotPeriod');
            $table->string('gainCumul');
            $table->string('priceGap');
            $table->string('globalGap');
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('period');
    }
}
