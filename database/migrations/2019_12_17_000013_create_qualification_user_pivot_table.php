<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('qualification_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_id_fk_740500')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('qualification_id');

            $table->foreign('qualification_id', 'qualification_id_fk_740500')->references('id')->on('qualifications')->onDelete('cascade');
        });
    }
}
