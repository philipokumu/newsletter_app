<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_subscriber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id')->references('id')->on('fields');
            $table->unsignedBigInteger('subscriber_id')->references('id')->on('subscribers');
            $table->string('field_value');
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
        Schema::dropIfExists('field_subscriber');
    }
};
