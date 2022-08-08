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
        Schema::create('camps', function (Blueprint $table) {

            $table->id();
            $table->string('nom', 100);
            $table->unsignedBigInteger('id_club');
            $table->unsignedInteger('capacitat');

            $table->timestamps();

            $table->foreign('id_club')
                ->references('id')
                ->on('clubs')
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
        Schema::drop('camps');
    }
};
