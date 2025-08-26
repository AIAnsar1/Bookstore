<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_author_can_be_created()
    {
        $author = Author::factory()->create();

        $this->assertInstanceOf(Author::class, $author);
        $this->assertDatabaseHas('authors', [
            'id' => $author->id
        ]);
    }

    public function test_author_has_many_products()
    {
        $author = Author::factory()->create();
        $products = Product::factory()->count(3)->create(['author_id' => $author->id]);

        $this->assertCount(3, $author->products);
        $this->assertInstanceOf(Product::class, $author->products->first());
    }

    public function test_author_translatable_attributes()
    {
        $author = Author::factory()->create([
            'name' => [
                'en' => 'Stephen King',
                'ru' => 'Стивен Кинг',
                'uz' => 'Stiven King'
            ],
            'description' => [
                'en' => 'Famous horror writer',
                'ru' => 'Знаменитый писатель ужасов',
                'uz' => 'Mashhur qorqinchli yozuvchi'
            ]
        ]);

        $this->assertEquals('Stephen King', $author->getTranslation('name', 'en'));
        $this->assertEquals('Стивен Кинг', $author->getTranslation('name', 'ru'));
        $this->assertEquals('Famous horror writer', $author->getTranslation('description', 'en'));
    }

    public function test_author_fillable_attributes()
    {
        $author = Author::factory()->create([
            'name' => 'Test Author',
            'photo' => 'author.jpg',
            'description' => 'Test Description',
        ]);

        $this->assertEquals('Test Author', $author->name);
        $this->assertEquals('author.jpg', $author->photo);
        $this->assertEquals('Test Description', $author->description);
    }
}
