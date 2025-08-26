<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Author;
use App\Models\Genre;
use App\Models\ProductRelaise;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created()
    {
        $product = Product::factory()->create();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
    }

    public function test_product_belongs_to_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $product->user);
        $this->assertEquals($user->id, $product->user->id);
    }

    public function test_product_belongs_to_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals($category->id, $product->category->id);
    }

    public function test_product_belongs_to_brand()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertInstanceOf(Brand::class, $product->brand);
        $this->assertEquals($brand->id, $product->brand->id);
    }

    public function test_product_belongs_to_author()
    {
        $author = Author::factory()->create();
        $product = Product::factory()->create(['author_id' => $author->id]);

        $this->assertInstanceOf(Author::class, $product->author);
        $this->assertEquals($author->id, $product->author->id);
    }

    public function test_product_has_many_product_relaises()
    {
        $product = Product::factory()->create();
        $relaises = ProductRelaise::factory()->count(3)->create(['product_id' => $product->id]);

        $this->assertCount(3, $product->productRelaises);
        $this->assertInstanceOf(ProductRelaise::class, $product->productRelaises->first());
    }

    public function test_product_belongs_to_many_genres()
    {
        $product = Product::factory()->create();
        $genres = Genre::factory()->count(2)->create();
        $product->genres()->attach($genres->pluck('id'));

        $this->assertCount(2, $product->genres);
        $this->assertInstanceOf(Genre::class, $product->genres->first());
    }

    public function test_product_translatable_attributes()
    {
        $product = Product::factory()->create([
            'title' => [
                'en' => 'English Title',
                'ru' => 'Russian Title',
                'uz' => 'Uzbek Title'
            ]
        ]);

        $this->assertEquals('English Title', $product->getTranslation('title', 'en'));
        $this->assertEquals('Russian Title', $product->getTranslation('title', 'ru'));
        $this->assertEquals('Uzbek Title', $product->getTranslation('title', 'uz'));
    }

    public function test_product_filter_by_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        
        $product1 = Product::factory()->create(['category_id' => $category1->id]);
        $product2 = Product::factory()->create(['category_id' => $category2->id]);

        $filteredProducts = Product::filter(['category_id' => $category1->id])->get();

        $this->assertCount(1, $filteredProducts);
        $this->assertEquals($product1->id, $filteredProducts->first()->id);
    }

    public function test_product_filter_by_brand()
    {
        $brand1 = Brand::factory()->create();
        $brand2 = Brand::factory()->create();
        
        $product1 = Product::factory()->create(['brand_id' => $brand1->id]);
        $product2 = Product::factory()->create(['brand_id' => $brand2->id]);

        $filteredProducts = Product::filter(['brand_id' => $brand1->id])->get();

        $this->assertCount(1, $filteredProducts);
        $this->assertEquals($product1->id, $filteredProducts->first()->id);
    }

    public function test_product_filter_by_author()
    {
        $author1 = Author::factory()->create();
        $author2 = Author::factory()->create();
        
        $product1 = Product::factory()->create(['author_id' => $author1->id]);
        $product2 = Product::factory()->create(['author_id' => $author2->id]);

        $filteredProducts = Product::filter(['author_id' => $author1->id])->get();

        $this->assertCount(1, $filteredProducts);
        $this->assertEquals($product1->id, $filteredProducts->first()->id);
    }

    public function test_product_fillable_attributes()
    {
        $product = Product::factory()->create([
            'title' => 'Test Book',
            'description' => 'Test Description', 
            'photo' => 'test.jpg',
            'pdf' => 'test.pdf',
            'selling_method' => 'digital',
            'price' => 29.99,
        ]);

        $this->assertEquals('Test Book', $product->title);
        $this->assertEquals('Test Description', $product->description);
        $this->assertEquals('test.jpg', $product->photo);
        $this->assertEquals('test.pdf', $product->pdf);
        $this->assertEquals('digital', $product->selling_method);
        $this->assertEquals(29.99, $product->price);
    }
}
