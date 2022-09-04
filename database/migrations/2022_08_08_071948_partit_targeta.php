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
        Schema::create('partit_targetes', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_partit');
            $table->unsignedBigInteger('id_jugador');
            $table->unsignedTinyInteger('minut');
            $table->boolean('groga')->default(false);
            $table->boolean('doble_groga')->default(false);
            $table->boolean('vermella')->default(false);

            $table->timestamps();

            $table->foreign('id_partit')
                ->references('id')
                ->on('partits')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_jugador')
                ->references('id')
                ->on('jugadors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partit_targetes');
    }
};
