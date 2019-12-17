<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('sign');

            $table->integer('next_qualification')->nullable();

            $table->string('description')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
