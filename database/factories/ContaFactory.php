<?php

namespace Database\Factories;

use App\Models\Conta;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => ucfirst($this->faker->unique()->word()),
            'icone' => $this->faker->randomElement(array_keys((new Conta())->getIcones())),
            'cor' => strtoupper(substr($this->faker->hexColor(), 1)),
            'valor_inicial' => $this->faker->optional(0.5, 0)->randomFloat(2, 1, 600),
            'usuario_id' => Usuario::inRandomOrder()->first()->getKey()
        ];
    }
}
