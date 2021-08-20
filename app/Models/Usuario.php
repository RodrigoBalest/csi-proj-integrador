<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class Usuario
 * @package App\Models
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property Carbon $email_verificado_em
 * @property string $senha
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Conta[] $contas
 *
 * @mixin Builder
 */
class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verificado_em' => 'datetime',
    ];

    /**
     * @inheritDoc
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Relacionamento com as contas do usuário.
     *
     * @return HasMany
     */
    public function contas()
    {
        return $this->hasMany(Conta::class, 'usuario_id');
    }
}
