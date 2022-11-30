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
        Schema::create('store_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->index('store_id');

            $table->enum('type', ['take_out', 'delivery']);

            $table->time('start_hour');
            $table->time('end_hour');

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
        Schema::dropIfExists('store_schedules');
    }
};
