<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('city');
            $table->string('address');
            $table->float('lat', 15, 10);
            $table->float('long', 15, 10);
            $table->smallInteger('n_rooms');
            $table->smallInteger('n_beds');
            $table->smallInteger('n_bathrooms');
            $table->smallInteger('square_meters');
            $table->string('thumb')->nullable();
            $table->boolean('visibility')->default(true);
            $table->string('slug')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('apartments');
    }
}
