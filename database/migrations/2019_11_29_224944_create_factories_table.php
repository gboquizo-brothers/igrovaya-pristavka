<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('factories', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->nullableUuidMorphs('factoriable');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('factory_translations', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('factory_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['factory_id', 'locale']);
            $table->foreign('factory_id')->references('id')
                ->on('factories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factory_translations');
        Schema::dropIfExists('factories');
    }
}
