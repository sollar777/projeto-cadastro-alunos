<?php

namespace App\Http\Controllers;

use App\Facedes\Utilities;
use Illuminate\Http\Request;


class ImportProdutosController extends Controller
{
    public function upload()
    {
        return view('produtos.importar_produtos');
    }

    public function uploadCsv(Request $request)
    {
        $dados = $request;
        $message = "";

        if (Utilities::uploadProdutos($dados)){
            $message = "Tudo Ok";
        }else{
            $message = "Error";
        }
        

        return Response()->json([$message],200);
    }

    //faltando fazer o model dos controoler pra savar os produtos


}
