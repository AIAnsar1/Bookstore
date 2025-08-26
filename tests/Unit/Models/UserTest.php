<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email
        ]);
    }

    public function test_user_belongs_to_country()
    {
        $country = Country::factory()->create();
        $user = User::factory()->create(['country_id' => $country->id]);

        $this->assertInstanceOf(Country::class, $user->countries);
        $this->assertEquals($country->id, $user->countries->id);
    }

    public function test_user_has_many_products()
    {
        $user = User::factory()->create();
        $products = Product::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->products);
        $this->assertInstanceOf(Product::class, $user->products->first());
    }

    public function test_user_has_many_payments()
    {
        $user = User::factory()->create();
        $payments = Payment::factory()->count(2)->create(['user_id' => $user->id]);

        $this->assertCount(2, $user->payments);
        $this->assertInstanceOf(Payment::class, $user->payments->first());
    }

    public function test_user_has_many_roles()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->roles()->attach($role);

        $this->assertCount(1, $user->roles);
        $this->assertInstanceOf(Role::class, $user->roles->first());
    }

    public function test_user_can_get_roles()
    {
        $user = User::factory()->create();
        
        // Create roles
        $role1 = Role::factory()->create(['name' => 'moderator']);
        $role2 = Role::factory()->create(['name' => 'editor']);
        
        $user->roles()->attach([$role1->id, $role2->id]);
        
        $roles = $user->roles;
        
        $this->assertCount(2, $roles);
        $this->assertTrue($roles->pluck('name')->contains('moderator'));
        $this->assertTrue($roles->pluck('name')->contains('editor'));
    }

    public function test_user_can_get_first_role()
    {
        $user = User::factory()->create();
        $role1 = Role::factory()->create(['name' => 'admin']);
        $role2 = Role::factory()->create(['name' => 'user']);
        
        $user->roles()->attach([$role1->id, $role2->id]);

        $this->assertEquals($role1->id, $user->roles->first()->id);
    }

    public function test_user_can_be_filtered()
    {
        $user1 = User::factory()->create(['firstname' => 'John']);
        $user2 = User::factory()->create(['firstname' => 'Jane']);
        
        $filteredUsers = User::filter(['firstname' => 'John'])->get();
        
        $this->assertCount(1, $filteredUsers);
        $this->assertEquals('John', $filteredUsers->first()->firstname);
    }

    public function test_user_filter_by_role()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $userRole = Role::factory()->create(['name' => 'user']);
        
        $adminUser = User::factory()->create();
        $regularUser = User::factory()->create();
        
        $adminUser->roles()->attach($adminRole);
        $regularUser->roles()->attach($userRole);
        
        $adminUsers = User::filter(['role' => 'admin'])->get();
        $regularUsers = User::filter(['role' => 'user'])->get();
        
        $this->assertCount(1, $adminUsers);
        $this->assertCount(1, $regularUsers);
    }

    public function test_user_fillable_attributes()
    {
        $userData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
            'phone_number' => '+1234567890',
            'address' => '123 Main St',
            'photo' => 'photo.jpg'
        ];

        $user = User::factory()->create($userData);

        $this->assertEquals('John', $user->firstname);
        $this->assertEquals('Doe', $user->lastname);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertEquals('+1234567890', $user->phone_number);
        $this->assertEquals('123 Main St', $user->address);
        $this->assertEquals('photo.jpg', $user->photo);
    }

    public function test_user_hidden_attributes()
    {
        $user = User::factory()->create();
        $userArray = $user->toArray();

        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }
}
