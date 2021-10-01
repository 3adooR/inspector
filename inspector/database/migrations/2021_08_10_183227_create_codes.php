<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('valid')->comment('Валидность вёрстки');
            $table->integer('errors', false, true)->comment('Кол-во ошибок вёрстки');
            $table->integer('warnings', false, true)->comment('Кол-во предупреждений вёрстки');
            $table->string('result', 127)->nullable(true)->comment('Результат валидатора');
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
        Schema::dropIfExists('codes');
    }
}
