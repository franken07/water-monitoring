<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserbsTable extends Migration
{
    public function up()
    {
        Schema::create('reserbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('create_products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('user_name');
            $table->string('user_email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reserbs');
    }
}