<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoseBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['Tepung', 'Tepung Beras 500g', 8500],
            ['Tepung', 'Tepung Beras Putih Premium 500g', 9500],
            ['Tepung', 'Tepung Beras 50kg', 380000],
            ['Tepung', 'Tepung Ketan Putih 500g', 8700],
            ['Tepung', 'Tepung Ketan Putih 50kg', 410000],
            ['Tepung', 'Tepung Tapioka 500g', 7200],
            ['Tepung', 'Tepung Tapioka 25kg', 260000],
            ['Tepung', 'Tepung Tapioka 50kg', 470000],
            ['Tepung', 'Tepung Tapioka GAM 50kg', 490000],
            ['Tepung', 'Tepung Maizena 250g', 7500],

            ['Gula', 'Gula Pasir Tebu 1kg', 18500],
            ['Gula', 'Gula Pasir Premium Hijau 1kg', 18500],
            ['Gula', 'Gula Halus 500g', 9500],
            ['Gula', 'Gula Cair 500ml', 14500],

            ['Minyak & Margarin', 'Minyak Goreng Cup 220ml', 4300],
            ['Minyak & Margarin', 'Minyak Goreng Pouch 500ml', 9900],
            ['Minyak & Margarin', 'Minyak Goreng Pouch 1L', 19000],
            ['Minyak & Margarin', 'Minyak Goreng Pouch 2L', 38000],
            ['Minyak & Margarin', 'Minyak Goreng 5L', 96500],
            ['Minyak & Margarin', 'Minyak Tawon Pouch 2L', 36000],
            ['Minyak & Margarin', 'Minyak Tawon 1L', 19500],
            ['Minyak & Margarin', 'Margarin Sachet 200g', 9800],
            ['Minyak & Margarin', 'Margarin Bucket 25kg', 520000],

            ['Santan & Olahan Kelapa', 'Santan Kelapa Karton 200ml', 6900],
            ['Santan & Olahan Kelapa', 'Del Coco Nata de Coco Sachet', 5100],

            ['Bihun Instan', 'Bihun Kaldu Ayam 10x55g', 21000],
            ['Bihun Instan', 'Bihun Asam Pedas 10x55g', 21000],

            ['Penyedap', 'MSG A1 Vetsin 50g', 5500],
            ['Penyedap', 'MSG A1 Vetsin 100g', 9000],
        ];

        $categories = [];

        foreach ($products as [$catName, $productName, $price]) {
            if (!isset($categories[$catName])) {
                $categories[$catName] = Category::create([
                    'name' => $catName,
                    'description' => "Kategori produk $catName dari Rose Brand"
                ])->id;
            }

            $categoryId = $categories[$catName];

            $product = Product::create([
                'category_id' => $categoryId,
                'name' => $productName,
                'slug' => Str::slug($productName),
                'description' => "Produk $productName dari Rose Brand.",
                'packaging' => null,
                'quantity' => 1,
                'price' => $price,
                'image' => null,
                'unit_name' => 'pcs',
                'form_type' => 'padat',
            ]);

            ProductStock::create([
                'product_id' => $product->id,
                'quantity' => 200,
            ]);
        }
    }
}
