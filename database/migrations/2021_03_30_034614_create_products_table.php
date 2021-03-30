<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('product_category_id')->default(0);
            $table->string('name', 100);
            $table->text('description');
            $table->boolean('is_new')->default(true);
            $table->mediumInteger('weight_gram')->default(0);
            $table->string('flag_variant')->default('P')->comment('P = NOT as variant fields, V = as variant field');
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
        Schema::dropIfExists('products');
    }
}
