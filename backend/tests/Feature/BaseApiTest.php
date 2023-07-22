<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class BaseApiTest extends TestCase
{
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
}
