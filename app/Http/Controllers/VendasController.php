<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Produto;
use App\Models\Venda;
use Exception;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alunos = Aluno::all();
        $produtos = Produto::all();
        return view('vendas.vendas_criar', compact('alunos', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $dados = $request->all();
            $aluno = Aluno::find($dados["aluno"])->first();
            $venda = $aluno->vendas()->create([
                "data" => $dados["data"],
                "finalizada" => 0
            ]);
            return response()->json([$venda], 200);
        }catch(Exception $e){
            return response()->json(["erro: " => $e], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function produto_aluno($id)
    {
        try{
            $aluno = Aluno::find($id);
            $turma = $aluno->turmas()->first();
            $produtos = $turma->produtos()->get();

            return response()->json([$produtos], 200);
        }catch(Exception $e){
            return response()->json(["erro: " => $e], 403);
        }

    }

    public function finalizarVenda(Request $request, $id)
    {
        try{
            $venda = Venda::find($id);
            $venda->update([
            "finalizada" => 1
        ]);
        $result["success"] = true;
        return response()->json([$result], 200);
        }catch(Exception $e){
            return response()->json(["erro: " => $e], 403);
        }
        
    }
}
