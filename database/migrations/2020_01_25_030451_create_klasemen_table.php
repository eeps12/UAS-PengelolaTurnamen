<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlasemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasemen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('peringkat',15);
            $table->string('menang',15);
            $table->string('kalah',15);
            $table->string('seri',15);
            $table->integer('turnamen_id')->index('turnamen_id_foreign');
            $table->integer('tim_id')->index('tim_id_foreign'); 
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
        Schema::dropIfExists('klasemen');
    }
}
