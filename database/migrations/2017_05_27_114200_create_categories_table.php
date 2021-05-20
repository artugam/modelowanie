<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
		
		DB::table('categories')->insert([
		'user_id' => '1',
		'name' => 'Motoryzacja',
		]);
		DB::table('categories')->insert([
		'user_id' => '1',
		'name' => 'Moda',
		]);
		DB::table('categories')->insert([
		'user_id' => '1',
		'name' => 'Mieszkania',
		]);
    }

    /**
     * Reverse the migrations.
     *
	 *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
