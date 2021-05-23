<?php

namespace Tests\Feature;

use App\Category;
use App\Comment;
use App\Post;
use App\User;
use Tests\TestCase;

class CommentControllerTest extends TestCase
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

        $response = $this->actingAs($admin)->post('/comment', [
            'post_id' => $post->id,
            'comment' => 'test-comment-create'
        ]);
        $response->assertStatus(302);
        $this->assertTrue(session('success') == 'Dodano komentarz');
        $this->assertTrue(Comment::where('comment', '=', 'test-comment-create')->count() > 0);


    }


    public function testDelete()
    {
        $admin = User::find(1);
        $category = new Category();
        $category->name = 'CategoryForPostCommentDelete';
        $category->user_id = $admin->id;
        $category->save();

        $post = new Post();
        $post->title = 'Post1ForCreateCommentDelete';
        $post->body = 'body1';
        $post->category_id =  $category->id;
        $post->user_id = 1;
        $post->city = 'cityForShow';
        $post->save();

        $comment = new Comment;
        $comment->comment = 'commentDelete';
        $comment->user_id = $admin->id;
        $comment->post_id = $post->id;
        $comment->save();

        $response = $this->actingAs($admin)->delete("/comment/{$post->id}/delete");
        $response->assertStatus(302);
        $this->assertTrue(session('success') == 'Usunięto komentarz');
        $this->assertTrue(Comment::where('comment', '=', 'commentDelete')->count() < 1);

    }
}

