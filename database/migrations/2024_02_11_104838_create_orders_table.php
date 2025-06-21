<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("company_name")->nullable();
            $table->string("address")->nullable();
            $table->string("apartment")->nullable();
            $table->string("city")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

            $table->integer("products");
            $table->integer("price");
            $table->integer("discount")->default(0);
            $table->integer("total");
            $table->integer("status")->default(0);
            $table->timestamps();
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
