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
        Schema::create('customer_service_surveys', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->integer("call_center_rate")->default(0);
            $table->integer("service_rate")->default(0);
            $table->boolean("issue_resolved")->default(false);
            $table->boolean("recommend")->default(false);
            $table->integer("paid_amount")->nullable();
            $table->integer("after_sale_rate")->default(0);
            $table->text("notes")->nullable();
            $table->boolean("seen")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_service_surveys');
    }
};
