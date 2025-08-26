<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_brand_can_be_created()
    {
        $brand = Brand::factory()->create();

        $this->assertInstanceOf(Brand::class, $brand);
        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => $brand->name
        ]);
    }

    public function test_brand_has_many_products()
    {
        $brand = Brand::factory()->create();
        $products = Product::factory()->count(3)->create(['brand_id' => $brand->id]);

        $this->assertCount(3, $brand->products);
        $this->assertInstanceOf(Product::class, $brand->products->first());
    }

    public function test_brand_fillable_attributes()
    {
        $brandData = [
            'name' => 'Penguin Books',
            'photo' => 'penguin.jpg'
        ];

        $brand = Brand::factory()->create($brandData);

        $this->assertEquals('Penguin Books', $brand->name);
        $this->assertEquals('penguin.jpg', $brand->photo);
    }
}
