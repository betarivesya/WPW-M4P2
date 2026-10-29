<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_upload_rejects_docx_and_displays_validation_error(): void
    {
        Storage::fake('public');

        $response = $this->followingRedirects()->from('/upload')->post('/upload', [
            'document' => UploadedFile::fake()->create(
                'document.docx',
                100,
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ),
        ]);

        $response->assertOk()
            ->assertSee('The document field must be a file of type: jpg, png, pdf.');

        $this->assertSame([], Storage::disk('public')->allFiles('documents'));
    }

    public function test_upload_rejects_files_larger_than_two_megabytes(): void
    {
        Storage::fake('public');

        $response = $this->followingRedirects()->from('/upload')->post('/upload', [
            'document' => UploadedFile::fake()->create('document.pdf', 2049, 'application/pdf'),
        ]);

        $response->assertOk()
            ->assertSee('The document field must not be greater than 2048 kilobytes.');

        $this->assertSame([], Storage::disk('public')->allFiles('documents'));
    }

    public function test_upload_stores_a_valid_pdf(): void
    {
        Storage::fake('public');

        $response = $this->from('/upload')->post('/upload', [
            'document' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        ]);

        $response->assertRedirect(route('upload.form'))
            ->assertSessionHas('success');

        $files = Storage::disk('public')->allFiles('documents');
        $this->assertCount(1, $files);
        Storage::disk('public')->assertExists($files[0]);
    }
}
