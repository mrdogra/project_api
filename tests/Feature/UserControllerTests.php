<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTests extends TestCase
{

    public function testIndexReturnsDataInValidFormat()
    {
        $this->json('get', 'api/tickets')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'requester',
                            'subject',
                            'department',
                            'help_topic',
                            'description'
                        ]
                    ]
                ]
            );
    }
}
