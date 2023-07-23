<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class BaseApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * checking custom response structure
     *
     * @param  TestResponse  $response
     * @return void
     */
    protected function assertResponseStructure(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'data',
            'errors',
            'errorMessage',
            'success',
        ]);
    }

    protected function assertResponseHasError(TestResponse $response): void
    {
        $this->checkSuccessField($response, false);

        $this->assertTrue($response->status() >= 400);

        $responseAsArray = $response->json();

        $this->assertNull($responseAsArray['data']);
        $this->assertNotEmpty($responseAsArray['errorMessage']);
    }

    protected function assertResponseOk(TestResponse $response): void
    {
        $this->checkSuccessField($response);

        $status = (string) $response->status();
        $this->assertTrue(\Str::startsWith($status, '2'));

        $responseAsArray = $response->json();

        $this->assertNotNull($responseAsArray['data']);
        $this->assertNull($responseAsArray['errors']);
        $this->assertNull($responseAsArray['errorMessage']);
    }

    private function checkSuccessField(TestResponse $response, bool $value = true): void
    {
        $this->assertTrue($response->json()['success'] === $value);
    }
}
