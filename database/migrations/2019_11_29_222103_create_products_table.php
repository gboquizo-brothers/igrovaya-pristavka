<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->nullableUuidMorphs('productable');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_translations', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['product_id', 'locale']);
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');
    }
}
