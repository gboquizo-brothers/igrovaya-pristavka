<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('factory_product', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('factory_id');
            $table->uuid('product_id');
            $table->timestamp('created_at');

            $table->foreign('factory_id')->references('id')
                ->on('factories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('factory_product');
    }
}
