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
        Schema::create('caregiver_details', function (Blueprint $table) {
            $table->id($column = 'caregiver_id');

            $table->string('assigned_member_name')->nullable();
            $table->string('assigned_member_email')->nullable();

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');

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
        Schema::dropIfExists('caregiver_details');
    }
};
