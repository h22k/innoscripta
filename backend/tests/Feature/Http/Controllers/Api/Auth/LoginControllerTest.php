<?php

namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Exceptions\WrongCredentialException;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\Feature\BaseApiTest;

class LoginControllerTest extends BaseApiTest
{
    public function test_email_field_is_required(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getLoginRoute(), [
            'password' => Str::random(),
        ]), ValidationException::class, 'The email field is required.');
    }

    public function test_password_field_is_required(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getLoginRoute(), [
            'email' => fake()->email,
        ]), ValidationException::class, 'The password field is required.');
    }

    public function test_if_credentials_are_wrong_then_throw_error(): void
    {
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getLoginRoute(), [
            'email'    => 'fakeemail@email.com',
            'password' => '324234234',
        ]), WrongCredentialException::class, WrongCredentialException::MESSAGE);
    }

    public function test_if_password_is_wrong_then_throw_error()
    {
        $user = User::factory()->create();
        $this->assertThrows(fn() => $this->withoutExceptionHandling()->postJson($this->getLoginRoute(), [
            'email'    => $user->email,
            'password' => 'wrong_password',
        ]), WrongCredentialException::class, WrongCredentialException::MESSAGE);
    }

    public function test_login_response_must_has_access_token(): void
    {
        $user = User::factory()->create([
            'password' => $password = Str::random(),
        ]);
        $response = $this->postJson($this->getLoginRoute(), [
            'email'    => $email = $user->email,
            'password' => $password,
        ]);

        $this->assertResponseStructure($response);
        $this->assertResponseOk($response);

        $response->assertCreated();

        $response->assertJsonPath('data.user.email', $email);

        $this->assertArrayHasKey('token', $response['data']);
        $this->assertArrayHasKey('expires_in', $response['data']);
        $this->assertArrayHasKey('type', $response['data']);

        $this->assertNotEmpty($response['data']['token']);
        $this->assertNotEmpty($response['data']['expires_in']);
        $this->assertNotEmpty($response['data']['type']);
    }

    public function test_authenticated_user_cant_login(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson($this->getLoginRoute(), [
            'email'    => fake()->email,
            'password' => \Str::random(),
        ]);

        $this->assertResponseStructure($response);
        $this->assertResponseHasError($response);

        $response->assertForbidden();
        $this->assertEquals('You do not have permission for this request!', $response['errorMessage']);
    }

    private function getLoginRoute(): string
    {
        return route('api.v1.auth.login');
    }
}
