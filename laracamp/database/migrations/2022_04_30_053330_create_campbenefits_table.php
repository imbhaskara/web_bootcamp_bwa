<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampbenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campbenefits', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('camp_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->SoftDeletes();

            // Table Relationship
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campbenefits');
    }
}
