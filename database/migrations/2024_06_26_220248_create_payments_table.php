<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employes');
            $table->string('amount');
            $table->dateTime('launch_date');
            $table->dateTime('done_date');

            $table->enum('status',['SUCCESS','FAILED'])->default('SUCCESS');
            $table->enum('month',[
                'JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER']);
            $table->string('year');
            $table->string('month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
