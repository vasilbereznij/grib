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
        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grib_id')->nullable()->comment('ID гриба')
                ->constrained() //создание связи:таблицу для связи и поле понимает по названию поля
                ->cascadeOnDelete()  //поведение при удалении
                ->cascadeOnUpdate();
            $table->tinyInteger('priority')->nullable()->comment('приоритет: 1-осн >1-показывать в порядке возрастания null-не показывать');
            $table->string('GribName', 50)->unique()->comment('назва');
            $table->string('Language', 2)->comment('мова');
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
        Schema::dropIfExists('names');
    }
};
