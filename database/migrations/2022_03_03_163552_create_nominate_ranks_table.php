<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominate_ranks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nominee')->default(0);

            $table->unsignedBigInteger('regimentID')->default(0);
            $table->unsignedBigInteger('companyID')->default(0);

            $table->unsignedBigInteger('rankID')->default(0);
            $table->integer('approved')->default(0);
            $table->boolean('reviewed')->default(false);
            $table->binary('coReason')->nullable();

            $table->unsignedBigInteger('nominator')->default(0);
            $table->binary('reason');

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
        Schema::dropIfExists('nominate_ranks');
    }
}
