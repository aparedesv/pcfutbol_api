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
        Schema::create('tipus_competicio', function (Blueprint $table) {

            $table->id();
            $table->string('nom', 50)->nullable();
            $table->boolean('lliga')->default(TRUE);
            $table->boolean('copa')->default(FALSE);
            $table->boolean('anada_tornada')->default(TRUE);
            $table->unsignedTinyInteger('numero_equips');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipus_competicio');
    }
};
