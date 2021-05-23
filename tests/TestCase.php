<?php

namespace Tests;

use App\Category;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var bool */
    protected static $once = false;

    /**
     * @throws
     */
    public function setUp()
    {
        parent::setUp();


        if (self::$once == false)
        {
            self::$once = true;

            try {
                DB::select('DROP table IF EXISTS categories');
                DB::select('DROP table IF EXISTS comments');
                DB::select('DROP table IF EXISTS friends');
                DB::select('DROP table IF EXISTS friend_post');
                DB::select('DROP table IF EXISTS migrations');
                DB::select('DROP table IF EXISTS offers');
                DB::select('DROP table IF EXISTS password_resets');
                DB::select('DROP table IF EXISTS posts');
                DB::select('DROP table IF EXISTS users');

            }catch (\Exception $exception) {
                echo $exception->getMessage();
            }

//            shell_exec('php artisan migrate');
            shell_exec('php artisan migrate:refresh --force');
//            shell_exec('php artisan db:seed');

//            $this->artisan();
//            if (env('CI', false) === false)
//            {
//                $this->artisan('migrate:refresh', ['--no-interaction' => true]);
//            }

//            $this->artisan('migrate');
//            $this->seed();
        }
    }
}

