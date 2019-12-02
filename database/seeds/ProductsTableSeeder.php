<?php

use App\Models\Book;
use App\Models\Factory;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $product = Product::create();

            $product->name = 'nombre';

            $product->save();

            $media = Media::create();

            $book = Book::create();

            $product->productable()->associate($media)->save();

            $media->mediable()->associate($book)->save();
        }

        $factory = Factory::create();

        $factory->products()->sync($product);
    }
}
