<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // id BIGINT (Primary)
            $table->string('name', 255);  // name VARCHAR(255) - Nama kategori
            $table->timestamps();  // created_at & updated_at (timestamps)
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }

};
