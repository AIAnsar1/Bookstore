<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Author;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_and_retrieve_product()
    {
        // Create dependencies
        $category = Category::factory()->create();
        $author = Author::factory()->create();
        $brand = Brand::factory()->create();
        $user = User::factory()->create();

        // Create product
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'author_id' => $author->id,
            'brand_id' => $brand->id,
            'user_id' => $user->id,
        ]);

        // Test product exists
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $category->id,
            'author_id' => $author->id,
            'brand_id' => $brand->id,
        ]);

        // Test relationships
        $this->assertEquals($category->id, $product->category->id);
        $this->assertEquals($author->id, $product->author->id);
        $this->assertEquals($brand->id, $product->brand->id);
    }

    public function test_can_create_category_hierarchy()
    {
        // Create parent category
        $parent = Category::factory()->create(['parent_id' => null]);
        
        // Create child category
        $child = Category::factory()->create(['parent_id' => $parent->id]);

        // Test hierarchy
        $this->assertEquals($parent->id, $child->parent_id);
        $this->assertTrue($parent->subCategories->contains($child));
    }

    public function test_product_has_translatable_fields()
    {
        $product = Product::factory()->create([
            'title' => [
                'en' => 'English Title',
                'ru' => 'Русское название',
                'uz' => 'O\'zbek nomi'
            ]
        ]);

        // Test translations
        $this->assertEquals('English Title', $product->getTranslation('title', 'en'));
        $this->assertEquals('Русское название', $product->getTranslation('title', 'ru'));
        $this->assertEquals('O\'zbek nomi', $product->getTranslation('title', 'uz'));
    }

    public function test_author_has_products_relationship()
    {
        $author = Author::factory()->create();
        $products = Product::factory()->count(3)->create(['author_id' => $author->id]);

        $this->assertCount(3, $author->products);
        foreach ($products as $product) {
            $this->assertTrue($author->products->contains($product));
        }
    }

    public function test_country_hierarchy_works()
    {
        // Create parent country
        $country = \App\Models\Country::factory()->create(['parent_id' => null]);
        
        // Create region (child)
        $region = \App\Models\Country::factory()->create(['parent_id' => $country->id]);

        // Test relationships
        $this->assertEquals($country->id, $region->parent_id);
        $this->assertTrue($country->regions->contains($region));
        $this->assertEquals($country->id, $region->country->id);
    }
}
