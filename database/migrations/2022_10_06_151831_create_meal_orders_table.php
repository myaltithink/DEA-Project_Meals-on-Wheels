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
        Schema::create('meal_orders', function (Blueprint $table) {

            //primary key
            $table->id('meal_order_id');

            //meal order native columns
            $table->string('meal_order_type')->nullable();
            $table->string('meal_order_status');
            $table->dateTime('meal_order_ordered_at')->nullable();
            $table->dateTime('meal_order_delivered_at')->nullable();

            //prepared by name and id
            $table->bigInteger('prepared_by_id')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('prepared_by_role')->nullable();

            //delivered by name and id
            $table->bigInteger('delivered_by_id')->nullable();
            $table->string('delivered_by')->nullable();

            //for referencing meals
            $table->foreignId('meal_plan_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_orders');
    }
};
