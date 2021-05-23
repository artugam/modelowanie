<?php

namespace Tests\Feature;

use App\Category;
use App\Comment;
use App\Offer;
use App\Post;
use App\User;
use Tests\TestCase;

class OfferControllerTest extends TestCase
{
    /**
     * Store company test
     *
     * @return void
     */
    public function testIndex()
    {
        $admin = User::find(1);

        $category = new Category();
        $category->name = 'CategoryForPostComment';
        $category->user_id = $admin->id;
        $category->save();

        $post = new Post();
        $post->title = 'Post1ForCreateComment';
        $post->body = 'body1';
        $post->category_id =  $category->id;
        $post->user_id = 1;
        $post->city = 'cityForShow';
        $post->save();

        $response = $this->actingAs($admin)->post('/offer', [
            'post_id' => $post->id,
            'price' => '123'
        ]);
        $response->assertStatus(302);
        $this->assertTrue(session('success') == 'Dziękuję za złożenie oferty');
        $this->assertTrue(Offer::where('post_id', '=', $post->id)->where('price', '=', '123')->count() > 0);

    }

}

