<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('course_id');
            $table->uuid('user_id')->nullable();
            $table->string('txid');
            $table->string('status');
            $table->unsignedInteger('price');
            $table->string('currency');
            $table->string('session_id')->nullable();
            $table->text('user_data')->nullable();
            $table->text('tx_data')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->string('flag')->nullable();
            $table->json('validation_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_purchases');
    }
}
