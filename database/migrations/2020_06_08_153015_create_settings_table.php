<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('site_name')->nullable();
            $table->text('logo')->nullable();
            $table->text('api_key')->nullable();
            $table->text('from_email')->nullable();
            $table->text('fav_icon')->nullable();
            $table->text('them_color')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
