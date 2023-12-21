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
            $table->id();
            $table->bigInteger('cate_id');
            $table->string('name');
            $table->string('slug');
            $table->mediumText('small_description')->nullable();
            $table->longText('description');
            $table->double('original_price');
            $table->double('selling_price');
            $table->string('image');
            $table->integer('qty')->default('0');
            $table->string('tax')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('trending');
            $table->integer('view_count')->nullable();
            $table->mediumText('meta_title')->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->mediumText('meta_description')->nullable();
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
