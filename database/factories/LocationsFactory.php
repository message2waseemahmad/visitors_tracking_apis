<?php

namespace Database\Factories;

use App\Models\locations;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationsFactory extends Factory
{
    protected $model = locations::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}

?>
