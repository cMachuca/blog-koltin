<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_get_author_page(): void
    {
        $user = User::factory()->create();
        $response = $this->get(route('author', $user->slug_name));

        $response->assertStatus(200);
    }

    public function test_get_api_authors(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/v1/authors');

        $response->assertStatus(200);
    }

    public function test_create_api_authors(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/authors', ['name' => 'John Doe', 'email' => 'john.doe@example.test', 'password' => 'Pass-12345']);

        $response->assertStatus(200);
    }
}
