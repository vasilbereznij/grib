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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grib_id')->nullable()
                ->constrained() //создание связи:таблицу для связи и поле понимает по названию поля
                ->cascadeOnDelete()  //поведение при удалении
                ->cascadeOnUpdate();
            $table->string('username')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps(); //добавляет поля created_at и updated_at(время создания-изменения)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
