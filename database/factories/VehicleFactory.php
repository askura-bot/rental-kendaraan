<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->word().' '.$this->faker->word(),
            'brand' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2015, 2026),
            'cc' => $this->faker->randomElement([800, 1000, 1200, 1500, 1800, 2000]),
            'capacity' => $this->faker->numberBetween(2, 8),
            'transmission' => $this->faker->randomElement(['manual', 'automatic']),
            'price_12h' => $this->faker->numberBetween(100, 500),
            'price_24h' => $this->faker->numberBetween(150, 800),
            'status' => $this->faker->randomElement(['available', 'rented', 'maintenance']),
            'description' => $this->faker->paragraph(),
            'thumbnail' => $this->faker->imageUrl(400, 300, 'vehicles', true, 'Faker'),
        ];
    }
}
