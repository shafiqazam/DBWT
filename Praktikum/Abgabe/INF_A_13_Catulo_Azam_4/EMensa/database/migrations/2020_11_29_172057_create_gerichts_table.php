<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGerichtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerichts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('beschreibung');
            $table->date('erfasst_am');
            $table->boolean('vegetarisch');
            $table->boolean('vegan');
            $table->double('preis_intern');
            $table->double('preis_extern');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerichts');
    }
}
