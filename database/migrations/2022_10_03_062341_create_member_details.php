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
        Schema::create('member_details', function (Blueprint $table) {
            $table->id($column = 'member_id');

            $table->string('proof_of_eligebility');
            $table->string('needs');
            $table->string('allergies')->nullable();

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
        Schema::dropIfExists('member_caregiver_profile');
    }
};
