<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_profile', function (Blueprint $table) {
            $table->id($column = 'profile_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('gender');
            $table->date('birthday');
            $table->string('contact_number');
            $table->string('address');
            $table->string('valid_id');

            $table->bigInteger('member_id')->nullable()->unsigned();
            $table->bigInteger('caregiver_id')->nullable()->unsigned();
            $table->bigInteger('volunteer_id')->nullable()->unsigned();

            $table->foreign('member_id')->references('member_id')->on('member_details');
            $table->foreign('caregiver_id')->references('caregiver_id')->on('caregiver_details');
            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteer_details');

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
        Schema::dropIfExists('individual_profile');
    }
};
