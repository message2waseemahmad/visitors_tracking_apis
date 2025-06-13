<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\locations;
use App\Models\sensors;


class sensorsControllerTest extends TestCase
{
    public function test_it_creates_a_sensor()
    {
        $location = locations::factory()->create();

        $response = $this->postJson('/api/sensors', [
            'name' => 'Sensor X',
            'status' => 'active',
            'location_id' => $location->id
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Sensor created successfully.']);
    }

    public function test_it_returns_all_sensors()
    {


        $response = $this->getJson('/api/sensors');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }


    public function test_it_returns_all_sensors_search_with_status()
    {


        $response = $this->getJson('/api/sensors', [

            'status' => 'inactive',

        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }


    public function test_it_returns_all_sensors_pagination()
    {


        $response = $this->getJson('/api/sensors', [

            'page' => 1,

        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }
}
