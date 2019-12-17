<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('description')->nullable();

            $table->string('confirmation_method')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
