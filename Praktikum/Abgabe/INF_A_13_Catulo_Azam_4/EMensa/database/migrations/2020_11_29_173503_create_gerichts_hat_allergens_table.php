<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGerichtsHatAllergensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerichts_hat_allergens', function (Blueprint $table) {
            $table->foreign('code')->references('code')->on('allergens');
            $table->string('code');
            $table->foreignId('gericht_id')->constrained('gerichts', 'id');
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
        Schema::dropIfExists('gerichts_hat_allergens');
    }
}
