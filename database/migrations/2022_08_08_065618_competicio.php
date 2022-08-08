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
        Schema::create('competicions', function (Blueprint $table) {

            $table->id();
            $table->string('nom', 50)->nullable();
            $table->unsignedBigInteger('id_temporada');

            $table->timestamps();

            $table->foreign('id_temporada')
                ->references('id')
                ->on('temporades')
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
        Schema::drop('competicions');
    }
};
