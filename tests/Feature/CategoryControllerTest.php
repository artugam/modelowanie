<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * Store company test
     *
     * @return void
     */
    public function testListingCategories()
    {
        $admin = User::find(1);

        $response = $this->actingAs($admin)->get('/category');
        $response->assertViewIs('category.index');
        $response->assertViewHas('categories');
    }
    /**
     * Store company test
     *
     * @return void
     */
    public function testStoringCategory()
    {
        $admin = User::find(1);

        $this->actingAs($admin)->post('/category', [
                'name' => 'TestCategoryCreate'
        ]);
        $this->assertNotEmpty(Category::where('name', 'TestCategoryCreate'));
        $this->assertTrue(session('success') == 'Dodano kategorie');
    }

}

