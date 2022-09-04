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
        Schema::create('tactica_partit_equips', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_partit');
            $table->unsignedBigInteger('id_tactica');
            $table->unsignedBigInteger('id_equip');
            $table->unsignedTinyInteger('minut_inici_tactica');
            $table->unsignedTinyInteger('minut_final_tactica');

            $table->timestamps();

            $table->foreign('id_partit')
                ->references('id')
                ->on('partits')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_tactica')
                ->references('id')
                ->on('tactiques')
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
        Schema::drop('tactica_partit_equips');
    }
};
