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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('unit_cost');
            $table->unsignedInteger('sale_price');
            $table->unsignedInteger('profit');

            $table->unsignedBigInteger('shipping_cost_id');
            $table->foreign('shipping_cost_id')->references('id')->on('shipping_costs');

            $table->unsignedBigInteger('coffee_id');
            $table->foreign('coffee_id')->references('id')->on('coffees');

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
        Schema::dropIfExists('sales');
    }
};
