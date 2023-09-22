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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grib_id')->nullable()->comment('ID гриба')
                ->constrained() //создание связи:таблицу для связи и поле понимает по названию поля
                ->cascadeOnDelete()  //поведение при удалении
                ->cascadeOnUpdate();
            $table->tinyInteger('priority')->nullable()->comment('приоритет: 1-главный 2-для отбора null-остальные');
            $table->string('GribImage')->nullable()->comment('ссылка на рисунок');
            $table->string('GribImage_preview')->nullable()->comment('ссылка на рисунок предварительного просмотра');
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
        Schema::dropIfExists('images');
    }
};
