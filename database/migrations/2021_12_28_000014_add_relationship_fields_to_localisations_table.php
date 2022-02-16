<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLocalisationsTable extends Migration
{
    public function up()
    {
        Schema::table('localisations', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id', 'region_fk_5689192')->references('id')->on('regions');
            $table->unsignedBigInteger('ville_id')->nullable();
            $table->foreign('ville_id', 'ville_fk_5689193')->references('id')->on('villes');
            $table->unsignedBigInteger('departement_id')->nullable();
            $table->foreign('departement_id', 'departement_fk_5689194')->references('id')->on('departements');
        });
    }
}
