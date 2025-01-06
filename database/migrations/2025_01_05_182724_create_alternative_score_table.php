<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alternative_scores', function (Blueprint $table) {
            $table->id();
            $table->float('score');
            $table->unsignedBigInteger('alternative_id');
            $table->unsignedBigInteger('criteria_id');
            
            $table->foreign('alternative_id')->references('alternative_id')->on('alternatives')->onDelete('cascade');
            $table->foreign('criteria_id')->references('criteria_id')->on('criterias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alternative_scores');
    }
};
