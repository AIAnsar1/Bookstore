<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created()
    {
        $category = Category::factory()->create();

        $this->assertInstanceOf(Category::class, $category);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id
        ]);
    }

    public function test_category_has_many_products()
    {
        $category = Category::factory()->create();
        $products = Product::factory()->count(3)->create(['category_id' => $category->id]);

        $this->assertCount(3, $category->products);
        $this->assertInstanceOf(Product::class, $category->products->first());
    }

    public function test_category_belongs_to_parent()
    {
        $parentCategory = Category::factory()->create();
        $childCategory = Category::factory()->create(['parent_id' => $parentCategory->id]);

        $this->assertInstanceOf(Category::class, $childCategory->parents);
        $this->assertEquals($parentCategory->id, $childCategory->parents->id);
    }

    public function test_category_has_many_subcategories()
    {
        $parentCategory = Category::factory()->create();
        $childCategories = Category::factory()->count(2)->create(['parent_id' => $parentCategory->id]);

        $this->assertCount(2, $parentCategory->subCategories);
        $this->assertInstanceOf(Category::class, $parentCategory->subCategories->first());
    }

    public function test_category_translatable_attributes()
    {
        $category = Category::factory()->create([
            'name' => [
                'en' => 'Fiction',
                'ru' => 'Художественная литература',
                'uz' => 'Badiiy adabiyot'
            ]
        ]);

        $this->assertEquals('Fiction', $category->getTranslation('name', 'en'));
        $this->assertEquals('Художественная литература', $category->getTranslation('name', 'ru'));
        $this->assertEquals('Badiiy adabiyot', $category->getTranslation('name', 'uz'));
    }

    public function test_category_fillable_attributes()
    {
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'photo' => 'test-category.jpg',
            'parent_id' => null,
        ]);

        $this->assertEquals('Test Category', $category->name);
        $this->assertEquals('test-category.jpg', $category->photo);
        $this->assertNull($category->parent_id);
    }

}
