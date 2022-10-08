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
        Schema::create('partit_actes', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_partit');
            $table->boolean('partit_finalitzat')->default(false);
            $table->boolean('equip_local_ok')->default(false);
            $table->boolean('equip_visitant_ok')->default(false);
            $table->unsignedInteger('assistencia')->nullable();
            $table->unsignedTinyInteger('gols_equip_local')->default(0);
            $table->unsignedTinyInteger('gols_equip_visitant')->default(0);

            $table->timestamps();

            $table->foreign('id_partit')
                ->references('id')
                ->on('partits')
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
        Schema::drop('partit_actes');
    }
};
