<?php

namespace App\Models;

use App\Scopes\UsuarioLogadoScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * Class Categoria
 * @package App\Models
 * @property string $nome
 * @property string $icone
 * @property string $cor
 * @property int $usuario_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Usuario $dono
 * @mixin Builder
 */
class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'icone',
        'cor',
        'usuario_id'
    ];

    /**
     * Os possíveis valores para os ícones.
     *
     * @var array
     */
    private static $icones = [
        'fa-home',
        'fa-car',
        'fa-wifi',
        'fa-shopping-cart',
        'fa-gamepad',
        'fa-balance-scale',
        'fa-money-bill-wave',
        'fa-piggy-bank',
        'fa-landmark',
        'fa-wallet',
        'fa-credit-card',
        'fa-heart',
        'fa-capsules',
        'fa-briefcase-medical',
        'fa-desktop',
        'fa-plane',
        'fa-graduation-cap',
        'fa-theater-masks',
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
     * Relacionamento: o proprietário da categoria.
     *
     * @see $dono
     * @return BelongsTo
     */
    public function dono()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }


}
