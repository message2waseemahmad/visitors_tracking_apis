<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\locations;
use App\Models\sensors;
use App\Models\visitors;


class summaryControllerTest extends TestCase
{
    public function test_it_returns_summary_data()
{
    // Seed some data

     $location = locations::factory()->create();
     $sensor_active = sensors::factory()->create(['name' => 'Test Sensor 1', 'status' => 'active', 'location_id' => $location->id]);
     $sensor_inactive = sensors::factory()->create(['name' => 'Test Sensor 2', 'status' => 'inactive', 'location_id' => $location->id]);

    visitors::factory()->create([
        'location_id' => $location->id,
        'sensor_id' => $sensor_active->id,
        'date' => now()->toDateString(),
        'total_visitors' => 100
    ]);

      visitors::factory()->create([
        'location_id' => $location->id,
        'sensor_id' => $sensor_inactive->id,
        'date' => now()->toDateString(),
        'total_visitors' => 50
    ]);

    // sensors::factory()->create(['status' => 'active']);
    // sensors::factory()->create(['status' => 'inactive']);

    $response = $this->getJson('/api/summary');

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     'total_visitors_last_7_days',
                     'sensor_status' => ['active', 'inactive']
                 ]
             ]);
}

}
