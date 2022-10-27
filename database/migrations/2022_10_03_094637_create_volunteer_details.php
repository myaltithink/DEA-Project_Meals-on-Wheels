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
        Schema::create('volunteer_details', function (Blueprint $table) {
            $table->id($column = 'volunteer_id');

            $table->string('volunteer_name');
            $table->string('volunteer_role');

            $table->string('organization_name')->nullable();
            $table->string('organization_address')->nullable();

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();

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
        Schema::dropIfExists('volunteer_details');
    }
};
