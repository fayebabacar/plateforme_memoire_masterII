<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPointdeausTable extends Migration
{
    public function up()
    {
        Schema::table('pointdeaus', function (Blueprint $table) {
            $table->unsignedBigInteger('localisation_id')->nullable();
            $table->foreign('localisation_id', 'localisation_fk_5689191')->references('id')->on('localisations');
        });
    }
}
