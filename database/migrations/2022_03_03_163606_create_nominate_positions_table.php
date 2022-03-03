<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominate_positions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nominee')->default(0);
            $table->unsignedBigInteger('regimentID')->default(0);
            $table->unsignedBigInteger('companyID')->default(0);
            $table->integer('position')->default(0);

            $table->integer('approval')->default(0);
            $table->unsignedBigInteger('reviewer')->default(0);
            $table->boolean('reviewed')->default(false);

            $table->binary('approvalReason')->nullable();
            $table->binary('nominationReason')->nullable();

            $table->unsignedBigInteger('nominator');


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
        Schema::dropIfExists('nominate_positions');
    }
}
