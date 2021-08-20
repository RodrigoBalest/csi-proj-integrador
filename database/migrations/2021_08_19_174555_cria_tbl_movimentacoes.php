<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTblMovimentacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor', 15, 2);
            $table->string('nome');
            $table->date('vence_em');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('recebe_de')->nullable();
            $table->unsignedBigInteger('envia_para')->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('recebe_de')->references('id')->on('contas')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('envia_para')->references('id')->on('contas')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentacoes');
    }
}
