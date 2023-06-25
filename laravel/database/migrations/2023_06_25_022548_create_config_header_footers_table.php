<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigHeaderFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_header_footers', function (Blueprint $table) {
            $table->id();
            $table->string('header_title')->nullable();
            $table->string('logo');
            $table->string('favicon');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('info')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('google_ads')->nullable();
            $table->string('google_console')->nullable();
            $table->string('google_map')->nullable();
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
        Schema::dropIfExists('config_header_footers');
    }
}
