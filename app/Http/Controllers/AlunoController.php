<?php

namespace App\Http\Controllers;

use App\Facedes\Utilities;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $alunos = DB::table("alunos")
                    ->join("turmas", "alunos.turma_id", "=", "turmas.id")
                    ->select("alunos.*", 
                    DB::raw("DATE_FORMAT(alunos.data_nascimento, '%d/%m/%Y') as data"),
                    "turmas.nome as turma")
                    ->get();

                    return view("cadastro.listagem_alunos", compact("alunos"));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $turmas = Turma::all();
        return view('cadastro.cadastro_alunos', compact('turmas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $turma = Turma::find($dados["turma"]);

        $turma->alunos()->create([
            "nome" => $dados["nome"],
            "data_nascimento" => $dados["data_nascimento"],
            "cep" => $dados["cep"],
            "endereco" => $dados["endereco"],
            "bairro" => $dados["bairro"],
            "cidade" => $dados["cidade"],
            "uf" => $dados["uf"]
        ]);

        return redirect(route('alunos.listagem'));
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

    public function buscarCep($cep)
    {
        
        $retorno = Utilities::getCep($cep);

        return response()->json([$retorno], 200);
    }

}
