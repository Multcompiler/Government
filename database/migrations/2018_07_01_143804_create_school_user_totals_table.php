<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolUserTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_user_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('school_id');
            $table->integer('kidato_id');
            $table->integer('requirement_category_id');
            $table->integer('male_total');
            $table->integer('female_total');
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
        Schema::dropIfExists('school_user_totals');
    }
}
