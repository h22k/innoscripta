<?php

namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\Feature\BaseApiTest;

class RegisterControllerTest extends BaseApiTest
{
    public function test_name_field_is_required(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getRegisterRoute(), [
            'email'    => fake()->email,
            'password' => Str::random(),
        ]), ValidationException::class, 'The name field is required.');
    }

    public function test_email_field_is_required(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getRegisterRoute(), [
            'name'     => fake()->name,
            'password' => Str::random(),
        ]), ValidationException::class, 'The email field is required.');
    }

    public function test_password_field_is_required(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getRegisterRoute(), [
            'name'  => fake()->name,
            'email' => fake()->email,
        ]), ValidationException::class, 'The password field is required.');
    }

    public function test_email_must_be_unique(): void
    {
        $user = User::factory()->create();

        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getRegisterRoute(), [
            'name'     => fake()->name,
            'email'    => $user->email,
            'password' => '234234234234',
        ]), ValidationException::class, 'The email has already been taken.');
    }

    public function test_password_must_has_min_8_chars(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getRegisterRoute(), [
            'name'     => fake()->name,
            'email'    => fake()->email,
            'password' => '1234',
        ]), ValidationException::class, 'The password field must be at least 8 characters.');
    }

    public function test_user_can_register_if_follows_rules(): void
    {
        $response = $this->postJson($this->getRegisterRoute(), [
            'email'    => $email = fake()->email,
            'name'     => $name = fake()->name,
            'password' => \Str::random(),
        ]);

        $this->assertResponseStructure($response);
        $this->assertResponseOk($response);

        $response->assertCreated();
        $response->assertJsonPath('data.user.name', $name);
        $response->assertJsonPath('data.user.email', $email);
    }

    public function test_register_response_must_has_access_token(): void
    {
        $response = $this->postJson($this->getRegisterRoute(), [
            'email'    => $email = fake()->email,
            'name'     => $name = fake()->name,
            'password' => \Str::random(),
        ]);

        $this->assertResponseStructure($response);
        $this->assertResponseOk($response);

        $response->assertCreated();

        $response->assertJsonPath('data.user.name', $name);
        $response->assertJsonPath('data.user.email', $email);

        $this->assertArrayHasKey('token', $response['data']);
        $this->assertArrayHasKey('expires_in', $response['data']);
        $this->assertArrayHasKey('type', $response['data']);

        $this->assertNotEmpty($response['data']['token']);
        $this->assertNotEmpty($response['data']['expires_in']);
        $this->assertNotEmpty($response['data']['type']);
    }

    public function test_authenticated_user_cant_register(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson($this->getRegisterRoute(), [
            'email'    => fake()->email,
            'name'     => fake()->name,
            'password' => \Str::random(),
        ]);

        $this->assertResponseStructure($response);
        $this->assertResponseHasError($response);

        $response->assertForbidden();
        $this->assertEquals('You do not have permission for this request!', $response['errorMessage']);
    }

    private function getRegisterRoute(): string
    {
        return route('api.v1.auth.register');
    }
}
