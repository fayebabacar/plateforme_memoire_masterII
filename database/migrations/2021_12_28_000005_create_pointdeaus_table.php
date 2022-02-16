<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointdeausTable extends Migration
{
    public function up()
    {
        Schema::create('pointdeaus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->float('latitude', 15, 5)->nullable();
            $table->float('longitude', 15, 6)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
