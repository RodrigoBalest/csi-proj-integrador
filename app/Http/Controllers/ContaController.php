<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContaController extends Controller
{
    private $contas;

    public function __construct(Conta $contas)
    {
        $this->contas = $contas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vars['contas'] = $this->contas->orderBy('created_at')->get();
        $vars['icones'] = $this->contas->getIcones();

        return view('contas.index', $vars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaRequest $request)
    {
        $conta = $this->contas->newInstance([
            'nome' => $request->input('nome'),
            'valor_inicial' => $request->input('valor_inicial'),
            'icone' => $request->input('icone'),
            'usuario_id' => Auth::id()
        ]);

        $conta->save();

        $request->session()->flash('success', 'Conta criada!');
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function show(Conta $conta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function edit(Conta $conta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conta $conta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conta $conta)
    {
        //
    }
}
