<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('state_id');
            $table->timestamps();
        });

        \App\Models\City::create(['name' => 'St. Louis', 'state_id' => 1]);
        \App\Models\City::create(['name' => 'Kansas City', 'state_id' => 1]);
        \App\Models\City::create(['name' => 'Springfield', 'state_id' => 1]);
        \App\Models\City::create(['name' => 'Dallas', 'state_id' => 2]);
        \App\Models\City::create(['name' => 'Houston', 'state_id' => 2]);
        \App\Models\City::create(['name' => 'Austin', 'state_id' => 2]);
        \App\Models\City::create(['name' => 'Jackson', 'state_id' => 3]);
        \App\Models\City::create(['name' => 'Biloxi', 'state_id' => 3]);
        \App\Models\City::create(['name' => 'Gulfport', 'state_id' => 3]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
