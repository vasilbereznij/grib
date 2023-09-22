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
        Schema::create('gribs', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('category_Type0')->nullable(); //для создание связи тип обязательно такой
            // $table->foreign('category_Type0')->references('Type0')->on('categories')  //создание связи:
            //     // $table->smallInteger('categorie_Type0')->nullable()->comment('тип общий: 1-шляпочный 2-шаровидный 3-Граната 4-Другие');
            $table->foreignId('category_Type0')->nullable()->comment('тип общий: 1-шляпочный 2-шаровидный 3-Граната 4-Другие')
                ->constrained() //создание связи:таблицу для связи(имя по модели) и поле понимает по названию поля
                ->cascadeOnDelete()  //поведение при удалении
                ->cascadeOnUpdate();
            $table->smallInteger('Type1')->nullable()->comment('тип ...');
            $table->smallInteger('Type2')->nullable()->comment('тип ...');
            $table->smallInteger('Type3')->nullable()->comment('тип ...');
            $table->smallInteger('Type4')->nullable()->comment('тип ...');
            $table->smallInteger('Type5')->nullable()->comment('тип ...');
            $table->smallInteger('Type6')->nullable()->comment('тип ...');
            $table->smallInteger('Type7')->nullable()->comment('тип ...');
            $table->smallInteger('Type8')->nullable()->comment('тип ...');
            $table->smallInteger('Type9')->nullable()->comment('тип ...');
            $table->boolean('is_public')->default(false)->comment('показати/ні');
            $table->timestamps(); //время создания-изменения (поля created_at и updated_at)
            $table->softDeletes()->comment('дата видалення');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gribs');
    }
};
