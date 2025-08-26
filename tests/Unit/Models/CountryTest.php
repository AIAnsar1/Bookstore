<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    public function test_country_can_be_created()
    {
        $country = Country::factory()->create();

        $this->assertInstanceOf(Country::class, $country);
        $this->assertDatabaseHas('countries', [
            'id' => $country->id
        ]);
    }

    public function test_country_has_many_regions()
    {
        $country = Country::factory()->create();
        $regions = Country::factory()->count(2)->region($country->id)->create();

        $this->assertCount(2, $country->regions);
        $this->assertInstanceOf(Country::class, $country->regions->first());
    }

    public function test_region_belongs_to_country()
    {
        $country = Country::factory()->create();
        $region = Country::factory()->region($country->id)->create();

        $this->assertInstanceOf(Country::class, $region->country);
        $this->assertEquals($country->id, $region->country->id);
    }

    public function test_country_translatable_attributes()
    {
        $country = Country::factory()->create([
            'country_info' => [
                'en' => 'United States',
                'ru' => 'Соединенные Штаты',
                'uz' => 'Amerika Qo\'shma Shtatlari'
            ]
        ]);

        $this->assertEquals('United States', $country->getTranslation('country_info', 'en'));
        $this->assertEquals('Соединенные Штаты', $country->getTranslation('country_info', 'ru'));
        $this->assertEquals('Amerika Qo\'shma Shtatlari', $country->getTranslation('country_info', 'uz'));
    }

    public function test_country_filter_scope()
    {
        $country = Country::factory()->create(['parent_id' => null]);
        $region = Country::factory()->create(['parent_id' => $country->id]);

        // Test country filter
        $countries = Country::filter(['country' => true])->get();
        $this->assertTrue($countries->contains($country));

        // Test region filter
        $regions = Country::filter(['region' => true])->get();
        $this->assertTrue($regions->contains($region));
    }

    public function test_country_fillable_attributes()
    {
        $country = Country::factory()->create([
            'country_info' => 'Test Country',
            'parent_id' => null
        ]);

        $this->assertEquals('Test Country', $country->country_info);
        $this->assertNull($country->parent_id);
    }

    public function test_country_has_country_info()
    {
        $country = Country::factory()->create();

        $this->assertNotNull($country->country_info);
    }
}
