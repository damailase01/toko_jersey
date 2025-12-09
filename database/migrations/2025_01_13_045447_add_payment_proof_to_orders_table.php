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
        // Menambahkan kolom 'payment_proof' pada tabel 'orders'
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_proof')->nullable(); // Kolom untuk menyimpan bukti pembayaran
        });
    }

    public function down()
    {
        // Menghapus kolom 'payment_proof' jika migrasi dibatalkan
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });
    }
};
