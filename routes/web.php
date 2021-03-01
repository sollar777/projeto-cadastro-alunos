<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ImportProdutosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\VendasItensController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos/importar', [ImportProdutosController::class, 'upload'])->name('produtos.importar');
Route::post('/produtos/importar', [ImportProdutosController::class, 'uploadCsv'])->name('produtos.importar.csv');

Route::get('/vendas/exibir', [VendasController::class, 'index'])->name('vendas.exibir');
Route::get('/vendas/criar', [VendasController::class, 'create'])->name('vendas.criar');
Route::post('/vendas/criar', [VendasController::class, 'store'])->name('vendas.salvar');
Route::get('/vendas/produto/buscar/{id}', [VendasController::class, 'produto_aluno'])->name('vendas.produto.buscar');
Route::put('/vendas/finalizar/{id}', [VendasController::class, 'finalizarVenda'])->name('vendas.finalizar');


Route::get('/vendasitens/editar/{id}', [VendasItensController::class, 'edit'])->name('vendas.itens.editar');
Route::put('/vendasitens/editar/{id}', [VendasItensController::class, 'update'])->name('vendas.itens.update');
Route::post('/vendasitens/adicionar', [VendasItensController::class, 'store'])->name('vendas.itens.adicionar');
Route::delete('/vendasitens/excluir/{id}', [VendasItensController::class, 'destroy'])->name('vendas.itens.excluir');


Route::get('/produtos/buscar/{id}', [ProdutosController::class, 'show'])->name('produtos.buscar');


Route::get('/alunos/listagem', [AlunoController::class, 'index'])->name('alunos.listagem');
Route::get('/alunos/criar', [AlunoController::class, 'create'])->name('alunos.criar');
Route::post('/alunos/criar', [AlunoController::class, 'store'])->name('alunos.salvar');
Route::get('/alunos/buscarcep/{cep}', [AlunoController::class, 'buscarCep'])->name('alunos.buscar.cep');
