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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("phone");
            $table->string("whatsapp");
            $table->string("city");
            $table->string("serial_number");
            $table->longText("address");
            $table->string("product");
            $table->longText("problem");
            $table->integer("status")->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
