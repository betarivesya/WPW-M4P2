<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_payload_creates_book_and_returns_201(): void
    {
        $payload = [
            'title' => 'Laravel API',
            'description' => 'A test book',
            'status' => 1,
        ];

        $response = $this->postJson('/api/books', $payload);

        $response->assertCreated()
            ->assertJsonPath('title', $payload['title'])
            ->assertJsonPath('description', $payload['description'])
            ->assertJsonPath('status', $payload['status']);

        $this->assertDatabaseHas('books', $payload);
    }

    public function test_missing_required_fields_return_422_without_creating_book(): void
    {
        $response = $this->postJson('/api/books', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'description', 'status']);

        $this->assertDatabaseCount('books', 0);
    }

    public function test_non_integer_status_returns_422_without_creating_book(): void
    {
        $response = $this->postJson('/api/books', [
            'title' => 'Laravel API',
            'description' => 'A test book',
            'status' => 'active',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('status');

        $this->assertDatabaseCount('books', 0);
    }
}
