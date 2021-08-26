<?php

namespace App\Observers;

use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Usuario;

class UsuarioObserver
{
    /**
     * Handle the Usuario "created" event.
     *
     * @param Usuario $usuario
     * @return void
     */
    public function created(Usuario $usuario)
    {
        // Cria no mínimo uma conta e uma categoria para o usuário.
        Conta::create([
            'nome' => 'Carteira',
            'valor_inicial' => 0,
            'icone' => 'carteira',
            'usuario_id' => $usuario->getKey()
        ]);

        Categoria::create([
            'nome' => 'Casa',
            'cor' => 'CCCCCC',
            'icone' => 'fa-home',
            'usuario_id' => $usuario->getKey()
        ]);
    }

    /**
     * Handle the Usuario "updated" event.
     *
     * @param Usuario $usuario
     * @return void
     */
    public function updated(Usuario $usuario)
    {
        //
    }

    /**
     * Handle the Usuario "deleted" event.
     *
     * @param Usuario $usuario
     * @return void
     */
    public function deleted(Usuario $usuario)
    {
        //
    }

    /**
     * Handle the Usuario "restored" event.
     *
     * @param Usuario $usuario
     * @return void
     */
    public function restored(Usuario $usuario)
    {
        //
    }

    /**
     * Handle the Usuario "force deleted" event.
     *
     * @param Usuario $usuario
     * @return void
     */
    public function forceDeleted(Usuario $usuario)
    {
        //
    }
}
