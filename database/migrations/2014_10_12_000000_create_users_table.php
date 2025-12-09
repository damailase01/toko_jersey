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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email pengguna
            $table->string('password'); // Password
            $table->string('phone_number')->nullable(); // Nomor telepon pengguna
            $table->text('address')->nullable(); // Alamat pengguna
            $table->enum('gender', ['male', 'female'])->nullable(); // Jenis kelamin
            $table->enum('role', ['admin', 'customer'])->default('customer'); // Peran pengguna (admin atau customer)
            $table->string('profile_photo')->nullable(); // Path ke foto profil (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
