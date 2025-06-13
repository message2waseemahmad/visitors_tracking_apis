<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\locations;
use App\Models\visitors;
use App\Models\sensors;


class visitorsControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_creates_a_visitor_record()
    {
        $location = locations::factory()->create();
        $sensor = sensors::factory()->create(['name' => 'Test Sensor', 'status' => 'active', 'location_id' => $location->id]);

        $response = $this->postJson('/api/visitors', [
            'location_id' => $location->id,
            'sensor_id' => $sensor->id,
            'date' => now()->toDateString(),
            'count' => 120
        ]);





        $response->assertStatus(201)->assertJsonFragment(['message' => 'Visitor data saved successfully.']);;
    }

    public function test_it_returns_all_visitors()
    {


        $response = $this->getJson('/api/visitors');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function test_it_returns_all_visitors_by_date()
    {


        $response = $this->getJson('/api/visitors', [

            'date' => now()->toDateString(),

        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }
}
