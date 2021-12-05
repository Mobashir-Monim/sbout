<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            // $table->uuid('course_category_id');
            $table->json('details')->nullable();
            $table->unsignedInteger('price');
            $table->string('currency');
            $table->string('provider');
            $table->string('provider_abbreviation');
            $table->integer('offered_to');
            $table->mediumText('description');
            $table->string('short');
            $table->text('thumbnail')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
