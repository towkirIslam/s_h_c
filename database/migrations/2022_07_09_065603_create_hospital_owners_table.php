<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_owners', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by')->nullable();
            $table->string('name', 50);
            $table->string('nid', 20);
            $table->string('password', 20);
            $table->string('confirm_password', 20);
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
        Schema::dropIfExists('hospital_owners');
    }
}
