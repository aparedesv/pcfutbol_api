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
        Schema::create('posicions', function (Blueprint $table) {

            $table->id();
            $table->char('nom', 3);
            $table->string('descripcio', 100)->nullable();
            $table->unsignedBigInteger('id_grup');

            $table->timestamps();

            $table->foreign('id_grup')
                ->references('id')
                ->on('grup_posicions')
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
        Schema::drop('posicions');
    }
};
