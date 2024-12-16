<?php

namespace Tests\Feature\API;

use App\Models\User;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private Country $country;

    protected function setUp(): void
    {
        parent::setUp();
        $this->country = Country::factory()->create(['name' => 'United States']);
    }

    public function test_user_can_register()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'country_id' => $this->country->id
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'country_id',
                    'is_active',
                    'created_at',
                    'updated_at'
                ],
                'access_token',
                'token_type'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'country_id' => $this->country->id
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'country_id' => $this->country->id
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'user',
                'access_token',
                'token_type'
            ]);
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'country_id' => $this->country->id
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(422);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create([
            'country_id' => $this->country->id
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Successfully logged out'
            ]);
    }

    public function test_user_can_get_profile()
    {
        $user = User::factory()->create([
            'country_id' => $this->country->id
        ]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/profile');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'country_id',
                    'country' => [
                        'id',
                        'name'
                    ]
                ]
            ]);
    }
}

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Country $country;

    protected function setUp(): void
    {
        parent::setUp();

        $this->country = Country::factory()->create(['name' => 'United States']);
        $this->user = User::factory()->create([
            'country_id' => $this->country->id
        ]);

        Sanctum::actingAs($this->user);
    }

    public function test_can_get_users_list()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'current_page',
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'email',
                            'country_id',
                            'is_active',
                            'country' => [
                                'id',
                                'name'
                            ]
                        ]
                    ]
                ],
                'message'
            ]);
    }

    public function test_can_create_user()
    {
        $userData = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'country_id' => $this->country->id
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'country_id',
                    'is_active'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'name' => 'New User'
        ]);
    }

    public function test_can_show_user()
    {
        $response = $this->getJson("/api/users/{$this->user->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'country_id',
                    'is_active',
                    'country' => [
                        'id',
                        'name'
                    ]
                ],
                'message'
            ]);
    }

    public function test_can_update_user()
    {
        $updateData = [
            'name' => 'Updated Name',
            'country_id' => $this->country->id
        ];

        $response = $this->putJson("/api/users/{$this->user->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data'
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Updated Name'
        ]);
    }

    public function test_can_delete_user()
    {
        $response = $this->deleteJson("/api/users/{$this->user->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User deleted successfully'
            ]);

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
            'deleted_at' => null
        ]);
    }

    public function test_cannot_create_user_with_duplicate_email()
    {
        $existingUser = User::factory()->create([
            'email' => 'existing@example.com',
            'country_id' => $this->country->id
        ]);

        $userData = [
            'name' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'country_id' => $this->country->id
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_cannot_update_user_with_invalid_country()
    {
        $updateData = [
            'country_id' => 999 // Non-existent country ID
        ];

        $response = $this->putJson("/api/users/{$this->user->id}", $updateData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['country_id']);
    }
}
