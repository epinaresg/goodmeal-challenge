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
        Schema::create('order_products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->index('store_id');

            $table->foreignUuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->index('order_id');

            $table->foreignUuid('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->index('product_id');

            $table->string('product_name');
            $table->integer('qty')->default(0);
            $table->decimal('total')->default(0);

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
        Schema::dropIfExists('order_products');
    }
};
