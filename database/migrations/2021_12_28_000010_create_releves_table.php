<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelevesTable extends Migration
{
    public function up()
    {
        Schema::create('releves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->date('date_releve');
            $table->float('value', 15, 2);
            $table->float('temperature', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
