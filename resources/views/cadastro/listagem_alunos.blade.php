@extends('layout.app')

@section('content')

<h3 class="h3-listagem-alunos">Listagem de Alunos</h3>
    
<table class="table table-striped listagem-alunos">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Turma</th>
            <th>Cep</th>
            <th>Endereço</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>UF</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alunos as $aluno)
        <tr>
            <td>{{$aluno->nome}}</td>
            <td>{{$aluno->data}}</td>
            <td>{{$aluno->turma}}</td>
            <td>{{$aluno->cep}}</td>
            <td>{{$aluno->endereco}}</td>
            <td>{{$aluno->bairro}}</td>
            <td>{{$aluno->cidade}}</td>
            <td>{{$aluno->uf}}</td>
        </tr>   
        @endforeach
    </tbody>
</table>

@endsection