@extends('layout.app')

@section('content')

<h3>Cadastro de Alunos</h3>

<input type="hidden" value="{{url('/')}}" id="url_aluno" name="url">

<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <label for="">Nome do aluno</label>
            <input type="text" class="form-control" name="nome">
        </div>
        <div class="col-md-4">
            <label for="">Data de nascimento</label>
            <input type="date" class="form-control" name="data_nascimento">
        </div>
        <div class="col-md-4">
            <label for="">Turma</label>
            <select name="turma" id="" class="form-control">
                <option value="0"></option>
                @foreach ($turmas as $turma)
                    <option value="{{$turma->id}}">{{$turma->nome}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="">Cep</label>
            <input type="text" name="cep" id="" class="form-control cep-aluno">
        </div>
        <div class="col-md-4">
            <label for="">Endereço</label>
            <input type="text" name="endereco" id="" class="form-control endereco-aluno">
        </div>
        <div class="col-md-2">
            <label for="">Bairro</label>
            <input type="text" name="bairro" id="" class="form-control bairro-aluno">
        </div>
        <div class="col-md-2">
            <label for="">Cidade</label>
            <input type="text" name="cidade" id="" class="form-control cidade-aluno">
        </div>
        <div class="col-md-2">
            <label for="">UF</label>
            <input type="text" name="uf" id="" class="form-control uf-aluno">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-success btn-salvar-aluno form-control">Salvar</button>
        </div>
    </div>
</form>
    
@endsection