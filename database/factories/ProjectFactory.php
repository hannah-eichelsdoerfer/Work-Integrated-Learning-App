<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\IndustryPartner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'contact_name' => $this->faker->name,
            'contact_email' => $this->faker->email,
            'num_students_needed' => $this->faker->numberBetween(3, 6),
            'trimester' => $this->faker->numberBetween(1, 3),
            'year' => $this->faker->numberBetween(2020, 2024),
            'industry_partner_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
