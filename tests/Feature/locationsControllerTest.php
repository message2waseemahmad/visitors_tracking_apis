<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\locations;

class locationsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_all_locations()
    {
        locations::factory()->count(3)->create();

        $response = $this->getJson('/api/locations');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    public function test_it_creates_a_location()
    {
        $response = $this->postJson('/api/locations', [
            'name' => 'Test Location'
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['message' => 'Location created successfully.']);
        $this->assertDatabaseHas('locations', ['name' => 'Test Location']);
    }
}
