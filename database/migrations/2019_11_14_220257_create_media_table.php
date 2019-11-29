<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('media', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->nullableUuidMorphs('mediable');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('media_translations', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('media_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['media_id', 'locale']);
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('media_translations');
        Schema::dropIfExists('media');
    }
}
