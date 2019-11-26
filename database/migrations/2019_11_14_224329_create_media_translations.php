<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_translations', static function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('media_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->timestamps();

            $table->unique(['media_id', 'locale']);
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_translations');
    }
}
