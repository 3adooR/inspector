<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->float('time')->default(0)->comment('Время загрузки в секундах');
            $table->integer('count_js', false, true)->default(0)->comment('Кол-во JS-файлов');
            $table->integer('count_css', false, true)->default(0)->comment('Кол-во CSS-файлов');
            $table->integer('count_images', false, true)->default(0)->comment('Кол-во изображений');
            $table->integer('count_css_images', false, true)->default(0)->comment('Кол-во изображений в CSS');
            $table->integer('weight_page', false, true)->default(0)->comment('Размер страницы');
            $table->integer('weight_js', false, true)->default(0)->comment('Размер JS-файлов');
            $table->integer('weight_css', false, true)->default(0)->comment('Размер CSS-файлов');
            $table->integer('weight_images', false, true)->default(0)->comment('Размер изображений');
            $table->integer('weight_css_images', false, true)->default(0)->comment('Размер изображений в CSS');
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
        Schema::dropIfExists('speeds');
    }
}
