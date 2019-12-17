<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResourcesTable extends Migration
{
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->unsignedInteger('goal_id')->nullable();

            $table->foreign('goal_id', 'goal_fk_740485')->references('id')->on('goals');
        });
    }
}
