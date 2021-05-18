<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * Store company test
     *
     * @return void
     */
    public function testIndex()
    {
        $admin = User::find(1);

        $response = $this->actingAs($admin)->get('/post');
        $response->assertViewIs('post.index');
        $response->assertViewHas('posts');
        $response->assertViewHas('categories');
        $response->assertStatus(200);
    }

    /**
     * Store company test
     *
     * @return void
     */
    public function testStore()
    {
        $admin = User::find(1);
        $category = new Category;
        $category->name = 'CategoryForPost';
        $category->user_id = $admin->id;
        $category->save();

        $data = [
            'title' => 'Post1',
            'body' => 'body1',
            'city' => 'city1',
            'category' => $category->id
        ];

        $response = $this->actingAs($admin)->call('POST', '/post', $data, [], []);
        $response->assertStatus(302);
        $response->assertRedirect('/post');
        $this->assertTrue(session('success') == 'Dodano ogłoszenie');
        $this->assertNotEmpty(Post::where('title', 'Post1'));
    }
}

