<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalQualificationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('goal_qualification', function (Blueprint $table) {
            $table->unsignedInteger('qualification_id');

            $table->foreign('qualification_id', 'qualification_id_fk_740496')->references('id')->on('qualifications')->onDelete('cascade');

            $table->unsignedInteger('goal_id');

            $table->foreign('goal_id', 'goal_id_fk_740496')->references('id')->on('goals')->onDelete('cascade');
        });
    }
}
