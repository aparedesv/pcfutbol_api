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
        Schema::create('competicio_equips', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_competicio');
            $table->unsignedBigInteger('id_equip');
            $table->unsignedTinyInteger('punts');
            $table->unsignedTinyInteger('gols_favor');
            $table->unsignedTinyInteger('gols_contra');

            $table->timestamps();

            $table->foreign('id_competicio')
                ->references('id')
                ->on('competicions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_equip')
                ->references('id')
                ->on('equips')
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
        Schema::drop('competicio_equips');
    }
};
