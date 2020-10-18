<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('status');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->string('company');
            $table->string('company_number');
            $table->string('address1');
            $table->string('address2');
            $table->string('town');
            $table->string('zip');
            $table->integer('shipping_different')->default(0);
            $table->string('s_firstname');
            $table->string('s_lastname');
            $table->string('s_email');
            $table->string('s_phone');
            $table->string('s_company');
            $table->string('s_address1');
            $table->string('s_address2');
            $table->string('s_town');
            $table->string('s_zip');
            $table->string('date');
            $table->string('dayname');
            $table->string('hour');
            $table->string('minute');
            $table->text('message');
            $table->double('total');
            $table->double('tax')->default(0);
            $table->integer('give_invoice')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
