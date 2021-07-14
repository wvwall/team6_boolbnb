<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
          $table->id();
           $table->foreignId('apartment_id')->constrained();
           $table->string('ip_address', 45);
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
        Schema::dropIfExists('views');
        
        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('views_apartment_id_foreign');
            $table->dropColumn('apartment_id');
        });
    }
}
