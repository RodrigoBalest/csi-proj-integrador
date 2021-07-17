<?php

namespace App\Models;

use App\Scopes\UsuarioLogadoScope;
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
 * @property float $valor_inicial
 * @property int $usuario_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Usuario $proprietario
 * @property-read float $saldo_atual
 * @mixin Builder
 */
class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor_inicial',
        'icone',
        'usuario_id'
    ];

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
     * Aplica o QueryScope global ao model
     */
    protected static function booted()
    {
        static::addGlobalScope(new UsuarioLogadoScope());
    }

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

    /**
     * Acessor: retorna o saldo atual da conta
     *
     * @todo retornar o cálculo real
     * @see $saldo_atual
     * @return float
     */
    public function getSaldoAtualAttribute()
    {
        return mt_rand(-10000, 90000) / 100;
    }
}
