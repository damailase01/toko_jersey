<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // ID produk
            $table->string('name');  // Nama produk
            $table->text('description')->nullable();  // Deskripsi produk
            $table->decimal('price', 10, 2);  // Harga produk
            $table->integer('stock');  // Jumlah stok produk
            $table->foreignId('category_id')->constrained('categories'); // Relasi dengan kategori
            $table->string('image_main');  // URL gambar utama
            $table->json('image_thumbnails');  // URL gambar thumbnail dalam format JSON
            $table->json('features');  // Fitur produk dalam bentuk list JSON
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
