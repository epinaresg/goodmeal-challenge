<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->index('store_id');

            $table->foreignUuid('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->index('product_id');

            $table->foreignUuid('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->index('category_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
};
