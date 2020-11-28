<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circle_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('circle_category_id')->default(1);
            $table->foreign('circle_category_id')->references('id')->on('circle_categories');
            $table->unsignedBigInteger('scale_id')->default(1);
            $table->foreign('scale_id')->references('id')->on('scales');
            $table->text('introduce')->nullable();
            $table->text('content')->nullable();
            $table->string('place')->nullable();
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
        Schema::dropIfExists('circle_settings');
    }
}
