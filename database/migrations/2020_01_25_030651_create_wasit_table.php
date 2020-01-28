<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wasit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_wasit',100);
            $table->string('email',100);
            $table->string('telepon',100);
            $table->string('alamat',100);
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
        Schema::dropIfExists('wasit');
    }
}
