<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CategoriaController extends Controller
{
    /**
     * @var Categoria
     */
    private $categorias;

    /**
     * Cria o controller injetando o model como dependência.
     *
     * CategoriaController constructor.
     * @param Categoria $categoria
     */
    public function __construct(Categoria $categoria)
    {
        $this->categorias = $categoria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vars['categorias'] = $this->categorias->all();
        $vars['icones'] = $this->categorias->getIcones();

        return view('categorias.index', $vars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoriaRequest $request
     * @return Response
     * @throws Throwable
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = $this->categorias->newInstance([
            'nome' => $request->input('nome'),
            'cor' => str_replace('#', '', $request->input('cor')),
            'icone' => $request->input('icone'),
            'usuario_id' => Auth::id()
        ]);

        $categoria->saveOrFail();

        $request->session()->flash('success', 'Categoria criada!');
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoriaRequest $request
     * @param Categoria $categoria
     * @return Response
     * @throws Throwable
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->nome = $request->input('nome');
        $categoria->cor = str_replace('#', '', $request->input('cor'));
        $categoria->icone = $request->input('icone');

        $categoria->saveOrFail();

        $request->session()->flash('success', 'Categoria alterada!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Categoria $categoria
     * @return Response
     */
    public function destroy(Request $request, Categoria $categoria)
    {
        $categoria->delete();

        $request->session()->flash('success', 'Categoria excluída!');
        return response()->json(['success' => true]);
    }
}
