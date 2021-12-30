<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->string('name');
            $table->timestamps();
        });


        \App\Models\Detail::create([
            'name' => 'nano 40',
            'service_id' => 1
        ]);


        \App\Models\Detail::create([
            'name' => 'nano 08',
            'service_id' => 2
        ]);


        \App\Models\Detail::create([
            'name' => 'nano 12',
            'service_id' => 1
        ]);


        \App\Models\Detail::create([
            'name' => 'nano 402',
            'service_id' => 2
        ]);



        \App\Models\Detail::create([
            'name' => 'nano 232',
            'service_id' => 1
        ]);


        \App\Models\Detail::create([
            'name' => 'nano 123',
            'service_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
