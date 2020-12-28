@extends('layout.app')

@section('content')

    <div class="row">
        <div class="col">
            <h1>Vendas</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <label class="lb-cod-venda">Código da Venda:</label>
        </div>
        <div class="col-md-2">
            <label class="codVenda">0</label>
        </div>
    </div>

    <form action="" class="form-cabecalho-vendas" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Data da venda</label>
                <input type="date" class="form-control" name="data" value="">
            </div>
            <div class="col-md-8 form-group">
                <label>Nome do aluno</label>
                <select name="aluno" id="" class="form-control select-aluno-venda">
                    <option value="0"></option>
                    @foreach ($alunos as $aluno)
                        <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6"></div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3 form-group">
                <button type="submit" class="btn btn-success form-control btn-vendas-iniciar">Iniciar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="form-check col-md-2">
                <input type="checkbox" class="form-check-input" name="finalizada" id="">
                <label class="form-check-label" for="defaultCheck2">Finalizada</label>
            </div>
        </div>
    </form>

    <form action="" method="" id="form-add-item" class="d-none">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label>Produto</label>
                <select name="produto" class="form-control select-produtos-venda">
                    <option value="0"></option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>quantidade</label>
                <input type="text" name="quantidade" class="form-control input-quantidade-vendas" value="0">
            </div>
            <div class="col-md-3">
                <label>Preço</label>
                <input type="text" name="preco" class="form-control input-preco-vendas" value="0">
            </div>
            <div class="col-md-2">
                <input type="hidden" name="codVenda" , value="" class="input-hidden-produto">
                <button type="submit" class="form-control btn btn-success b-adicionar-prod-venda">Adicionar</button>
            </div>
        </div>
    </form>

    <div class="d-none div-table-produtos-venda">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Editar/Remover</th>
                </tr>
            </thead>
            <form action="" method="">
                <input type="hidden" name="_token" class="hidden-table-token" value="{{ csrf_token() }}">
                <tbody class="tbody-vendas-itens">

                </tbody>
            </form>
        </table>
    </div>

    <form action="" method="" class="form-finalizar-venda">
    @csrf
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <input type="hidden" name="codvenda" value="" class="hidden-codVenda-finalizar">
            <button type="submit" class="btn btn-success btn-finalizar-venda d-none">Finalizar Venda</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>


    <!-- Modal -->
    <div class="modal fade modal-principal-editar-produto" id="modalVendaEditProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="modal-item-venda" id="">
                        @csrf
                        <label>Produto</label>
                        <input type="text" name="nome" class="form-control modal-nome-produto" style="border: none"
                            disabled>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Quantidade</label>
                                <input type="text" name="quantidade" class="form-control modal-quantidade-produto">
                            </div>
                            <div class="col-md-6">
                                <label>Preço</label>
                                <input type="text" name="preco" class="form-control modal-preco-produto">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Total</label>
                                <input type="text" name="tot" class="form-control modal-tot-produto" style="border: none"
                                    disabled>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="" class="modal-hidden-vendaitem-id">
                    <button type="button" class="btn btn-secondary btn-modal-fechar" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary btn-modal-salvar-edicao">Salvar mudanças</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{url('/')}}" id="url_vendas" name="url">


@endsection
