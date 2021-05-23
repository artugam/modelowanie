<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * Store company test
     *
     * @return void
     */
    public function testHomeView()
    {
        $admin = User::find(1);

        $response = $this->actingAs($admin)->get('/home');
        $response->assertStatus(200);
    }

    /**
     * Store company test
     *
     * @return void
     */
    public function testListUser()
    {
        $admin = User::find(1);

        $response = $this->actingAs($admin)->get('/users');
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertViewHas('users');
    }

    public function testShowUser() {
        $admin = User::find(1);

        $response = $this->actingAs($admin)->get("/users/{$admin->id}");
        $response->assertStatus(200);
        $response->assertViewIs('user.show');
        $response->assertViewHas('user');
    }
}

