<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGerichtHatKategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gericht_hat_kategories', function (Blueprint $table) {
            $table->foreignId('gericht_id')->constrained('gerichts', 'id');
            $table->foreignId('kategorie_id')->constrained('kategories', 'id');
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
        Schema::dropIfExists('gericht_hat_kategories');
    }
}
