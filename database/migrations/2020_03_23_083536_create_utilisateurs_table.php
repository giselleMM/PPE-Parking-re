<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateutilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pseudo', 50)->unique();
            $table->char('mdp', 60);
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 60)->unique();
            $table->char('telephone', 10)->unique();
            $table->integer('rang')->nullable();
            $table->string('role',25);
            $table->unsignedBigInteger('ligue_id')->nullable();
            $table->foreign('ligue_id')->references('id')->on('ligues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
