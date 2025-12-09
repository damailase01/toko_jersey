<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_orders_table.php
public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan dengan user
        $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Menghubungkan dengan produk
        $table->string('size'); // Ukuran produk
        $table->integer('quantity'); // Jumlah produk yang dibeli
        $table->decimal('price', 15, 2); // Harga satuan produk
        $table->decimal('total_price', 15, 2); // Harga total produk
        $table->decimal('shipping_cost', 15, 2); // Ongkos kirim
        $table->text('address'); // Alamat pengiriman
        $table->string('city'); // Kota pengiriman
        $table->string('courier'); // Metode pengiriman
        $table->string('payment_method'); // Metode pembayaran
        $table->enum('status', ['pending', 'paid', 'shipped', 'delivered', 'cancelled'])->default('pending'); // Status pesanan
        $table->timestamps(); // Menyimpan timestamp create dan update
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
