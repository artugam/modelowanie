<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

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


//            shell_exec('php artisan migrate');
            shell_exec('php artisan migrate:refresh');
            shell_exec('php artisan db:seed');

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

