<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Movimentacao;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class MovimentacaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movimentacao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'valor' => $this->faker->randomFloat(2, 0, 1000),
            'nome' => $this->faker->words($this->faker->numberBetween(1, 3), true),
            'vence_em' => $this->faker->dateTimeBetween('-6 months', '+1 year'),
            'usuario_id' => function () {
                $u = Usuario::inRandomOrder()->first();
                return is_null($u) ? Usuario::factory() : $u->getKey();
            },
            'categoria_id' => function (array $attrs) {
                $cat = Categoria::withoutGlobalScopes()
                    ->where('usuario_id',  $attrs['usuario_id'])
                    ->inRandomOrder()
                    ->first();

                return is_null($cat)
                    ? Categoria::factory()->state(['usuario_id' => $attrs['usuario_id']])
                    : $cat->getKey();
            },
            'recebe_de' => function (array $attrs) {
                $isDespesa = $this->faker->boolean();
                if (! $isDespesa) {
                    return null;
                }

                $conta = Conta::withoutGlobalScopes()
                    ->where('usuario_id', $attrs['usuario_id'])
                    ->inRandomOrder()
                    ->first();

                return is_null($conta)
                    ? Conta::factory()->state(['usuario_id' => $attrs['usuario_id']])
                    : $conta->getKey();
            },
            'envia_para' => function (array $attrs) {
                if (! is_null($attrs['recebe_de'])) {
                    return null;
                }

                $conta = Conta::withoutGlobalScopes()
                    ->where('usuario_id', $attrs['usuario_id'])
                    ->inRandomOrder()
                    ->first();

                return is_null($conta)
                    ? Conta::factory()->state(['usuario_id' => $attrs['usuario_id']])
                    : $conta->getKey();
            }
        ];
    }

    public function paraUsuario(int $id)
    {
        return $this->state(function () use ($id) {
            return [
                'usuario_id' => $id
            ];
        });
    }
}
