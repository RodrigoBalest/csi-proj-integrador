<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * Class Conta
 * @package App\Models
 * @property int $id
 * @property string $nome
 * @property string $icone
 * @property string $cor
 * @property float $valor_inicial
 * @property int $usuario_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Usuario $proprietario
 * @mixin Builder
 */
class Conta extends Model
{
    use HasFactory;

    /**
     * Os possíveis valores para os ícones.
     *
     * @var array
     */
    private static $icones = [
        'carteira' => 'Carteira',
        'bb' => 'Banco do Brasil',
        'caixa' => 'Caixa',
        'itau' => 'Itaú',
        'mastercard' => 'Mastercard',
        'nubank' => 'Nubank',
        'santander' => 'Santander',
        'sicredi' => 'Sicredi'
    ];

    /**
     * Relacionamento: o proprietário da conta.
     *
     * @see $proprietario
     * @return BelongsTo
     */
    public function dono()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Retorna as opções possíveis de ícones.
     *
     * @return array
     */
    public function getIcones()
    {
        return self::$icones;
    }
}
