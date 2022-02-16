<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRelevesTable extends Migration
{
    public function up()
    {
        Schema::table('releves', function (Blueprint $table) {
            $table->unsignedBigInteger('pointdeau_id')->nullable();
            $table->foreign('pointdeau_id', 'pointdeau_fk_5689197')->references('id')->on('pointdeaus');
        });
    }
}
