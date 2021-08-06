<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => ucfirst($this->faker->unique()->word()),
            'icone' => $this->faker->randomElement((new Categoria())->getIcones()),
            'cor' => str_replace('#', '', $this->faker->hexColor()),
            'usuario_id' => Usuario::inRandomOrder()->first()->getKey()
        ];
    }
}
