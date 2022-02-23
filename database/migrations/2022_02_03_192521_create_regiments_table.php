<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regiments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('abrv');
            $table->string('type');
            $table->string('descriptor');

            //$table->foreignId('CO');
            $table->unsignedBigInteger('co_id');

            //$table->foreignId('XO');
            $table->unsignedBigInteger('xo_id');

            //$table->foreignId('SgtMaj');
            $table->unsignedBigInteger('sgtMaj_id');

            $table->json('advisors');
            $table->json('companies');

            $table->string('regimentalColors')->nullable();

            $table->unsignedBigInteger('createdBy');

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
        Schema::dropIfExists('regiments');
    }
}
