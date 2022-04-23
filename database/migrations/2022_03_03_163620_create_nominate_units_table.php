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
        Schema::create('unit_transfers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transferee')->default(0);

            $table->unsignedBigInteger('currentCompany')->default(0);
            $table->unsignedBigInteger('currentRegiment')->default(0);
            $table->unsignedBigInteger('currentCO')->default(0);
            $table->integer('currentApproval')->default(0);
            $table->binary('currentReason')->nullable();

            $table->unsignedBigInteger('nextCompany')->default(0);
            $table->unsignedBigInteger('nextRegiment')->default(0);
            $table->unsignedBigInteger('nextCO')->default(0);
            $table->integer('nextApproval')->default(0);
            $table->binary('nextReason')->nullable();

            $table->unsignedBigInteger('requester')->default(0);
            $table->binary('reason')->nullable;
            $table->integer('approved')->default(0);

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
        Schema::dropIfExists('unit_transfers');
    }
}
