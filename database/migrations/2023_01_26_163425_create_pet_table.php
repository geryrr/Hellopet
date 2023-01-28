<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->id();
            $table->string('checkup_id');
            $table->string('pet_name');
            $table->string('pet_age');
            $table->string('pet_disease');
            $table->string('pet_gender');
            $table->string('owner_name');
            $table->string('doctor_name');
            $table->longText('notes')->nullable(); //dibuat nullable karena optional
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
        Schema::dropIfExists('pet');
    }
} 