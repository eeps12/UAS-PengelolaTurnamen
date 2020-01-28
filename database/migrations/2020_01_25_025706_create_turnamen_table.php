<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnamen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_turnamen',100);
            $table->date('tgl_mulai',100);
            $table->date('tgl_selesai',100);
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
        Schema::dropIfExists('turnamen');
    }
}
