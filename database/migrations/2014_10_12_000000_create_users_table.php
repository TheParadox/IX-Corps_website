<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('discordName');
            $table->string('companyToolName');
            $table->date('dateJoined');
            $table->date('dateDischarged')->nullable();
            $table->text('reasonForDischarge');
            $table->boolean('isDischarged')->default(0);

            $table->boolean('isLOA')->default(0);
            $table->date('startLOA')->nullable();
            $table->date('endLOA')->nullable();
            $table->text('reasonForLOA');
            $table->unsignedBigInteger('loaGranter')->default(0);

            //$table->foreignId('regiment_id');
            $table->unsignedBigInteger('regiment_id')->default(0);
            //$table->foreign('regiment_id')->references('id')->on('regiments');

            //$table->foreignId('company_id');
            $table->unsignedBigInteger('company_id')->default(0);
            //$table->foreign('company_id')->references('id')->on('companies');

            //$table->foreignId('rank_id');
            $table->unsignedBigInteger('rank_id')->default(0);
            //$table->foreign('rank_id')->references('id')->on('ranks');

            //still need awards...

            $table->integer('numberDrillsAttended')->default(0);
            $table->integer('numberOfEventsAttended')->default(0);
            $table->date('lastDrill')->nullable();
            $table->date('lastEvent')->nullable();

            $table->unsignedBigInteger('recruiter_id');
            $table->unsignedBigInteger('processor_id');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
