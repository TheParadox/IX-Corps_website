<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominate_units', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transferee')->default(0);

            $table->unsignedBigInteger('currentUnit')->default(0);
            $table->unsignedBigInteger('currentCO')->default(0);
            $table->integer('currentApproval')->default(0);
            $table->binary('currentReason')->nullable();

            $table->unsignedBigInteger('nextUnit')->default(0);
            $table->unsignedBigInteger('nextCO')->default(0);
            $table->integer('nextApproval')->default(0);
            $table->binary('nextReason')->nullable();

            $table->unsignedBigInteger('requester')->default(0);
            $table->binary('reason')->nullable;

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
        Schema::dropIfExists('nominate_units');
    }
}
