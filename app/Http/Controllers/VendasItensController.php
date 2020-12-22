<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Venda_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasItensController extends Controller
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
        //
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
        $venda = Venda::find($dados["codVenda"]);
        $venda->vendasEfetuadas()->create([
            "produto_id" => $dados["produto"],
            "preco" => $dados["preco"],
            "quantidade" => $dados["quantidade"]
        ]);

        $vendas_itens = DB::table("vendas_itens")
            ->join("produtos", "vendas_itens.produto_id", "=", "produtos.id")
            ->select(
                "vendas_itens.id",
                "vendas_itens.quantidade",
                "vendas_itens.preco",
                "vendas_itens.produto_id",
                "vendas_itens.venda_id",
                "produtos.nome"
            )
            ->where("vendas_itens.venda_id", $dados["codVenda"])
            ->get();


        return response()->json([$vendas_itens], 200);
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

        $venda_item = DB::table("vendas_itens")
            ->join("produtos", "vendas_itens.produto_id", "=", "produtos.id")
            ->select(
                "vendas_itens.id",
                "vendas_itens.quantidade",
                "vendas_itens.preco",
                "vendas_itens.produto_id",
                "vendas_itens.venda_id",
                "produtos.nome"
            )
            ->where("vendas_itens.id", $id)
            ->first();

        return response()->json([$venda_item], 200);
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
        $dados = $request->all();
        $venda_item = Venda_Item::find($id);

        $venda_item->update([
            "quantidade" => $dados["quantidade"],
            "preco" => $dados["preco"]
        ]);

        $vendas_itens = DB::table("vendas_itens")
            ->join("produtos", "vendas_itens.produto_id", "=", "produtos.id")
            ->select(
                "vendas_itens.id",
                "vendas_itens.quantidade",
                "vendas_itens.preco",
                "vendas_itens.produto_id",
                "vendas_itens.venda_id",
                "produtos.nome"
            )
            ->where("vendas_itens.venda_id",  $venda_item->venda_id)
            ->get();

            return response()->json([$vendas_itens], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venda_item = Venda_Item::find($id);
        $id_venda = $venda_item->venda_id;
        $venda_item->delete();
        $vendas_itens = DB::table("vendas_itens")
            ->join("produtos", "vendas_itens.produto_id", "=", "produtos.id")
            ->select(
                "vendas_itens.id",
                "vendas_itens.quantidade",
                "vendas_itens.preco",
                "vendas_itens.produto_id",
                "vendas_itens.venda_id",
                "produtos.nome"
            )
            ->where("vendas_itens.venda_id",  $id_venda)
            ->get();

            return response()->json([$vendas_itens], 200);
    }
}
