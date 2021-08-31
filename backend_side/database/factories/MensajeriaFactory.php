<?php

namespace Database\Factories;

use App\Models\mensajeria;
use Illuminate\Database\Eloquent\Factories\Factory;

class MensajeriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = mensajeria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'atencionCliente' => $this->faker->phoneNumber(),
        ];
    }
}
