<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            //$table->foreignId('regiment');
            $table->unsignedBigInteger('regiment_id');
            //$table->foreign('regiment_id')->references('id')->on('regiments');

            $table->string('letter');

            //$table->foreignId('CO');
            $table->unsignedBigInteger('co_id');
            //$table->foreign('co_id')->references('id')->on('users');

            //$table->foreignId('FirstSgt');
            $table->unsignedBigInteger('firstSgt_id');
            //$table->foreign('firstSgt_id')->references('id')->on('users');

            $table->json('sgts');
            $table->json('cpls');
            $table->json('troops');

            $table->boolean('isActive');

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
        Schema::dropIfExists('companies');
    }
}
