<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemain', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama',100);
            $table->string('posisi',100);
            $table->string('no_punggung',100);
            $table->string('email',100);
            $table->integer('team_id')->index('team_id_foreign'); 
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
        Schema::dropIfExists('pemain');
    }
}
