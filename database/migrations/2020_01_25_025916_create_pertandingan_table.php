<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertandinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertandingan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ket_pertandingan',100);
            $table->string('hasil_pertandingan',100);
            $table->integer('tima_id')->index('tima_id_foreign'); 
            $table->integer('timb_id')->index('timb_id_foreign'); 
            $table->integer('wasit_id')->index('wasit_id_foreign'); 
            $table->integer('admin_id')->index('admin_id_foreign'); 
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
        Schema::dropIfExists('pertandingan');
    }
}
