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
        Schema::create('partits', function (Blueprint $table) {

            $table->id();
            $table->string('nom', 50)->nullable();
            $table->unsignedBigInteger('id_competicio');
            $table->unsignedTinyInteger('jornada')->nullable();
            $table->unsignedBigInteger('id_equip_local');
            $table->unsignedBigInteger('id_equip_visitant');
            $table->unsignedBigInteger('id_camp')->nullable();
            $table->dateTime('inici');

            $table->timestamps();

            $table->foreign('id_competicio')
                ->references('id')
                ->on('competicions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_equip_local')
                ->references('id')
                ->on('equips')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_equip_visitant')
                ->references('id')
                ->on('equips')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_camp')
                ->references('id')
                ->on('camps')
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
        Schema::drop('partits');
    }
};
