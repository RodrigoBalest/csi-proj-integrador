<?php

namespace App\Models;

use App\Scopes\UsuarioLogadoScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property Usuario $dono
 *
 * @property-read Collection|Movimentacao[] $receitas
 * @property-read Collection|Movimentacao[] $despesas
 *
 * @property-read float $saldo_atual
 *
 * @mixin Builder
 */
class Conta extends Model
{
    use HasFactory;

    protected $table = 'contas';

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
     * Retorna as opções possíveis de ícones.
     *
     * @return array
     */
    public function getIcones()
    {
        return self::$icones;
    }

    /**
     * Relacionamento: o proprietário da conta.
     *
     * @see $dono
     * @return BelongsTo
     */
    public function dono()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Relacionamento com as movimentações que colocam dinheiro nesta conta.
     *
     * @return HasMany
     */
    public function receitas()
    {
        return $this->hasMany(Movimentacao::class, 'envia_para');
    }

    /**
     * Relacionamento com as movimentações que retiram dinheiro desta conta.
     *
     * @return HasMany
     */
    public function despesas()
    {
        return $this->hasMany(Movimentacao::class, 'recebe_de');
    }

    /**
     * Acessor: retorna o saldo atual da conta
     *
     * @see $saldo_atual
     * @return float
     */
    public function getSaldoAtualAttribute()
    {
        $valor = $this->valor_inicial;

        foreach ($this->receitas as $receita) {
            $valor += $receita->valor;
        }

        foreach ($this->despesas as $despesa) {
            $valor -= $despesa->valor;
        }

        return $valor;
    }
}
