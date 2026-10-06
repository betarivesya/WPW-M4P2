<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UppercaseValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_uses_email_field_instead_of_nim(): void
    {
        $this->get('/uppercase')
            ->assertOk()
            ->assertSee('name="email"', false)
            ->assertSee('type="email"', false)
            ->assertSee('minlength="3"', false)
            ->assertSee('maxlength="50"', false)
            ->assertSee('minlength="6"', false)
            ->assertDontSee('name="password_confirmation"', false)
            ->assertDontSee('name="nim"', false)
            ->assertDontSee('NIM (Nomor Induk Mahasiswa)');
    }

    public function test_valid_uppercase_name_displays_styled_success_message_on_form(): void
    {
        $response = $this->from('/uppercase')->post('/uppercase', [
            'name' => 'NAMA LENGKAP',
            'email' => 'nama@example.test',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/uppercase');
        $this->get('/uppercase')
            ->assertOk()
            ->assertSee('Nama berhasil divalidasi!')
            ->assertSee('class="alert-success"', false);
    }

    public function test_lowercase_name_redirects_back_with_validation_error(): void
    {
        $response = $this->from('/uppercase')->post('/uppercase', [
            'name' => 'Nama Lengkap',
            'email' => 'nama@example.test',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/uppercase')
            ->assertSessionHasErrors('name');
    }

    public function test_name_must_have_at_least_three_characters(): void
    {
        $this->from('/uppercase')->post('/uppercase', [
            'name' => 'AB',
            'email' => 'nama@example.test',
            'password' => 'secret123',
        ])->assertRedirect('/uppercase')
            ->assertSessionHasErrors('name');
    }

    public function test_email_must_be_unique(): void
    {
        $existingUser = User::factory()->create();

        $this->from('/uppercase')->post('/uppercase', [
            'name' => 'NAMA LENGKAP',
            'email' => $existingUser->email,
            'password' => 'secret123',
        ])->assertRedirect('/uppercase')
            ->assertSessionHasErrors('email');
    }

    public function test_password_must_have_at_least_six_characters(): void
    {
        $this->from('/uppercase')->post('/uppercase', [
            'name' => 'NAMA LENGKAP',
            'email' => 'nama@example.test',
            'password' => 'short',
        ])->assertRedirect('/uppercase')
            ->assertSessionHasErrors(['password']);
    }
}
