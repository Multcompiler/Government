<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('posted_user_id');
            $table->integer('school_id');
            $table->integer('kidato_id');
            $table->integer('requirement_category_id');
            $table->string('category_name');
            $table->integer('amount_available');
            $table->integer('amount_needed');
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
        Schema::dropIfExists('school_requirements');
    }
}
