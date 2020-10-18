<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('product_name_dch')->nullable();
            $table->text('product_description_dch')->nullable();
            $table->integer('fid')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('product_number')->nullable();
            $table->string('sell_product_option')->nullable();
            $table->string('price_per_person')->nullable();
            $table->string('min_person')->nullable();
            $table->string('max_person')->nullable();
            $table->string('price_per_unit')->nullable();
            $table->string('price_weight')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_person')->nullable();
            $table->string('status')->nullable();
            $table->string('allday_availability')->nullable();
            $table->string('availability')->nullable();
            $table->string('advance_payment')->nullable();
            $table->string('available_after')->nullable();
            $table->string('duedate')->nullable();
            $table->string('conserve_min')->nullable();
            $table->string('conserve_max')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('barcode_nbr')->nullable();
            $table->string('format_label')->nullable();
            $table->string('type')->nullable();
            $table->string('type_label')->nullable();
            $table->text('extra_notification_dch')->nullable();
            $table->text('ingredients_dch')->nullable();
            $table->string('e_val_1')->nullable();
            $table->string('e_val_2')->nullable();
            $table->string('carbo')->nullable();
            $table->string('sugar')->nullable();
            $table->string('fats')->nullable();
            $table->string('sat_fats')->nullable();
            $table->string('salt')->nullable();
            $table->string('fibers')->nullable();
            $table->string('natrium')->nullable();
            $table->string('allergence_dch')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
