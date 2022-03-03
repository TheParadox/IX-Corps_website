<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominate_awards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nominee')->default(0);
            $table->unsignedBigInteger('award')->default(0);
            $table->binary('reason')->nullable();
            $table->integer('approved')->default(0);
            $table->unsignedBigInteger('approvedBy')->default(0);
            $table->binary('approvedReason');

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
        Schema::dropIfExists('nominate_awards');
    }
}
