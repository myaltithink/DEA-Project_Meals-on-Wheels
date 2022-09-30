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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');

            // user data
            $table->string("email")->unique();
            $table->string("password");
            $table->decimal("longtitude");
            $table->decimal("latitude");
            $table->integer("details_id");
            $table->integer("profile_id");
            $table->string("status");
            $table->string("reason_of_rejection")->nullable();

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
        //
    }
};
