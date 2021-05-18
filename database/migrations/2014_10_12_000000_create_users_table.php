<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefon');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('users')->insert([
            'username' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.pl',
            'password' => bcrypt('admin'),
            'telefon' => '111111111',
            'role' => 'Admin',
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
        Schema::dropIfExists('users');
    }
    
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.pl',
            'password' => bcrypt('admin'),
            'telefon' => '111111111',
            'role' => 'Admin',
        ]);
    }
    
}
