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
        Schema::create('tactiques', function (Blueprint $table) {

            $table->id();
            $table->string('nom', 50)->nullable();
            $table->char('defenses', 1);
            $table->char('mitjos', 1);
            $table->char('davanters', 1);
            $table->boolean('entrelinies_defensa')->default(false);
            $table->boolean('entrelinies_atac')->default(false);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tactiques');
    }
};
