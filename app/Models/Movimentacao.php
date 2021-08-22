<?php

namespace App\Models;

use App\Scopes\UsuarioLogadoScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Movimentacao
 * @package App\Models
 * @property int $id
 * @property float $valor
 * @property string $nome
 * @property Carbon $vence_em
 * @property int $categoria_id
 * @property int|null $recebe_de
 * @property int|null $envia_para
 * @property int $usuario_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Categoria $categoria
 * @property-read Conta|null $origem
 * @property-read Conta|null $destino
 * @property-read Usuario $usuario
 *
 * @property-read bool $is_receita
 * @property-read bool $is_despesa
 * @property-read bool $is_transferencia
 *
 * @method self porMesVcto(int $mes)
 * @method self porAnoVcto(int $ano)
 *
 * @mixin Builder
 */
class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';

    protected $casts = [
        'vence_em' => 'datetime:Y-m-d'
    ];

    protected $fillable = [
        'nome',
        'valor',
        'vence_em',
        'categoria_id',
        'recebe_de',
        'envia_para',
        'usuario_id'
    ];

    /**
     * Aplica o QueryScope global ao model
     */
    protected static function booted()
    {
        static::addGlobalScope(new UsuarioLogadoScope());
    }

    /**
     * Relacionamento com o model Categoria
     * @return BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relacionamento com a conta para onde o dinheiro vai, se esta movimentação for uma receita.
     * @return BelongsTo
     */
    public function origem()
    {
        return $this->belongsTo(Conta::class, 'recebe_de');
    }

    /**
     * Relacionamento com a conta para onde o dinheiro vai, se esta movimentação for uma despesa.
     * @return BelongsTo
     */
    public function destino()
    {
        return $this->belongsTo(Conta::class, 'envia_para');
    }

    /**
     * Relacionamento com o usuário dono desta movimentação.
     * @return BelongsTo
     */
    public function dono()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function scopePorMesVcto(Builder $query, $mes)
    {
        return $query->whereMonth('vence_em', '=', $mes);
    }

    public function scopePorAnoVcto(Builder $query, $ano)
    {
        return $query->whereYear('vence_em', '=', $ano);
    }

    public function getIsReceitaAttribute()
    {
        return is_null($this->recebe_de) && ! is_null($this->envia_para);
    }

    public function getIsDespesaAttribute()
    {
        return ! is_null($this->recebe_de) && is_null($this->envia_para);
    }

    public function getIsTransferenciaAttribute()
    {
        return ! is_null($this->recebe_de) && ! is_null($this->envia_para);
    }
}
