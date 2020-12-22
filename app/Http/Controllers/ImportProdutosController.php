<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Turma;
use App\Models\Turma_Produto;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;
use SplTempFileObject;

class ImportProdutosController extends Controller
{
    public function upload()
    {
        return view('produtos.importar_produtos');
    }

    public function uploadCsv(Request $request)
    {
        if ($request->csv->isValid()) {
            //dd($request->csv->extension()); pega a extensao
            // $teste = explode(".", $request->csv->getClientOriginalName());
            // return $teste;
            //dd($request->csv->getClientOriginalName());
            $file = $request->csv->storeAs('csv', 'produtos' . CarbonImmutable::now()->isoFormat('DD-MM-YYYY') . '.csv');
        }

        $mercadorias = Produto::all();
        $turmas = Turma::all();

        $csv = Reader::createFromPath('../storage/app/' . $file, 'r');
        $csv->setDelimiter(";");
        $headers = $csv->setHeaderOffset(0);

        $stmt = (new Statement())->offset(0);

        $records = $stmt->process($csv);
        $headers = $records->getHeader();
        $produtos = [];

        foreach ($records as $key => $record) {

            $produtos[$key] = array_values($record);
        }

        foreach ($produtos as $produto) {
            $mercadoria = $mercadorias->where("nome", $produto[0])->first();
            if (!$mercadoria) {
                $mercadoria = Produto::create([
                    "nome" => $produto[0],
                    "preco" => $produto[1],
                    "estoque" => $produto[2]
                ]);
            }
            for ($i = 0; $i < count($produto); $i++) {
                if ($produto[$i] === "x") {
                    $turma = $turmas->where('nome', $headers[$i])->first();
                    $produtos_turmas = $turma->produtos()->where("produto_id", $mercadoria->id);
                    if (!$produtos_turmas) {
                        $ligacao = Turma_Produto::create([
                            "turma_id" => $turma->id,
                            "produto_id" => $mercadoria->id
                        ]);
                    }
                }
            }
        }
    }

    //faltando fazer o model dos controoler pra savar os produtos


}
