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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->index('store_id');

            $table->string('store_name')->nullable();
            $table->string('store_address')->nullable();

            $table->string('code')->nullable();
            $table->integer('qty_products')->default(0);
            $table->decimal('total')->default(0);

            $table->string('order_type')->nullable();
            $table->date('order_date')->nullable();
            $table->string('order_time')->nullable();

            $table->string('customer_address')->nullable();

            $table->char('open', 1)->default(1);
            $table->string('state')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
