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
        Schema::create('stores', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('logo');

            $table->string('name');

            $table->string('slug')->nullable();

            $table->string('address');
            $table->integer('stock')->default(0);
            $table->char('take_out', 1)->default(0);
            $table->char('delivery', 1)->default(0);
            $table->string('rating');

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
        Schema::dropIfExists('stores');
    }
};
