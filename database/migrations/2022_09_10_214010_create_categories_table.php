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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Type0')->index()->nullable()->comment('№ розділу');
            $table->smallInteger('Type1')->nullable()->comment('тип напр: 1-шляпочный 2-шаровидный 3-Граната 4-Другие');
            $table->string('Title')->nullable();
            $table->text('Description')->nullable()->comment('описание');

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
        Schema::dropIfExists('categories');
    }
};
