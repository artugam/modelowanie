<?php

namespace Tests\Feature;

use App\Category;
use App\Comment;
use App\Friend;
use App\Offer;
use App\Post;
use App\User;
use Tests\TestCase;

class FriendControllerTest extends TestCase
{
    /**
     * Store company test
     *
     * @return void
     */
    public function testIndex()
    {
        $admin = User::find(1);

        $friendTest = new User();
        $friendTest->fill([
            'username' => 'FriendTest',
            'surname' => 'FriendTest',
            'email' => 'FriendTest@admin.pl',
            'password' => bcrypt('FriendTest'),
            'telefon' => '111111111',
            'role' => 'Admin',
        ]);
        $friendTest->save();

        $response = $this->actingAs($admin)->post('/friend', [
            'friend_id' => $friendTest->id,
        ]);

        $response->assertStatus(200);
        $this->assertTrue(Friend::where('user_id_1', '=', $admin->id)->where('user_id_2', '=', $friendTest->id)->count() > 0);

    }

    public function testRemove()
    {
        $admin = User::find(1);

        $friendTest = new User();
        $friendTest->fill([
            'username' => 'FriendTestForDelete',
            'surname' => 'FriendTestForDelete',
            'email' => 'FriendTestForDelete@admin.pl',
            'password' => bcrypt('FriendTestForDelete'),
            'telefon' => '111111111',
            'role' => 'Admin',
        ]);
        $friendTest->save();

        $friends = new Friend();
        $friends->user_id_1 = $admin->id;
        $friends->user_id_2 = $friendTest->id;
        $friends->save();


        $response = $this->actingAs($admin)->post('/friend/remove', [
            'friend_id' => $friendTest->id,
        ]);

        $response->assertStatus(200);
        $this->assertTrue(Friend::where('user_id_1', '=', $admin->id)->where('user_id_2', '=', $friendTest->id)->count() < 1);

    }

}

