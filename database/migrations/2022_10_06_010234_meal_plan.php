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
        Schema::create('meal_plan', function(Blueprint $table){
            //primary key
            $table->id('meal_plan_id');

            //details
            $table->string('meal_name');
            $table->longText('meal_ingredients');
            $table->longText('meal_image_path');
            $table->longText('reason_for_rejection')->nullable();
            $table->string('status');

            //proposed by (no foreign key constraint to avoid deleting meal plan if user is deleted from the database)
            $table->string('proposed_by');
            $table->string('proposed_by_role');
            $table->string('organization');

            //userId is not foreign key to avoid deleting records made here if user is deleted
            $table->bigInteger('user_id');
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
