<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function test_show_single_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('single-post', $post->slug));

        $response->assertStatus(200);
    }

    public function test_show_single_not_valid_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('single-post', $post->slug.'blabla'));

        $response->assertStatus(500);
    }

    public function test_get_api_post(): void
    {
        $user = User::factory()->create();
        Post::factory(5)->create();
        Comment::factory()->create(['commentable_type' => 'posts', 'commentable_id' => Post::factory()->create()->id]);

        $response = $this->actingAs($user)
            ->get('/api/v1/posts');

        $response->assertStatus(200);
        $jsonResponse = $response->json();

        $this->assertArrayHasKey('author', array_shift($jsonResponse));
    }

    public function test_create_api_post(): void
    {
        $user = User::factory()->create();
        Post::factory(5)->create();
        Comment::factory()->create(['commentable_type' => 'posts', 'commentable_id' => Post::factory()->create()->id]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/posts', ['title' => 'test post', 'content content']);

        $response->assertStatus(200);
    }

    public function test_create_api_duplicate_post(): void
    {
        $user = User::factory()->create();
        Post::factory(5)->create();
        Comment::factory()->create(['commentable_type' => 'posts', 'commentable_id' => Post::factory()->create()->id]);

        $this->actingAs($user)
            ->postJson('/api/v1/posts', ['title' => 'test post', 'content content']);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/posts', ['title' => 'test post', 'content content']);

        $response->assertStatus(400);
    }
}
