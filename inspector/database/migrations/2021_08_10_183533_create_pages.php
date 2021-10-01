<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('parent')->default(0)->comment('ID страницы родителя');
            $table->unsignedInteger('code')->default(0)->comment('Код ответа');
            $table->string('title')->nullable()->comment('Mata-tag Title');
            $table->string('description')->nullable()->comment('Meta-tag Description');
            $table->string('keywords')->nullable()->comment('Meta-tag Keywords');
            $table->string('h1')->nullable()->comment('H1-tag');
            $table->timestamps();
            $table->boolean('parsed')->default(false)->comment('Статус парсинга');
            $table->index('parent');
            $table->index('parsed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
