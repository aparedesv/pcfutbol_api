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
        Schema::create('plantilles', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_equip');
            $table->unsignedBigInteger('id_jugador');

            $table->timestamps();

            $table->foreign('id_equip')
                ->references('id')
                ->on('equips')
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
        Schema::drop('jugadors');
    }
};
