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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->index('store_id');

            $table->string('name');
            $table->string('image');

            $table->decimal('price_with_discount')->default(0);
            $table->decimal('price_without_discount')->default(0);

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
        Schema::dropIfExists('products');
    }
};
