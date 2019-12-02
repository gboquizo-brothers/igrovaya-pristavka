<?php

declare(strict_types=1);

use App\Enums\MediaFormatsEnum;
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
            $table->enum('format', MediaFormatsEnum::getValues())->default(MediaFormatsEnum::DIGITAL);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
}
