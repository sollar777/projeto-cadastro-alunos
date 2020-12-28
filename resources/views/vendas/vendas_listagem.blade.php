@extends('layout.app')

@section('content')

<h3 class="h3-vendas">Listagem de Vendas</h3>
    
<table class="table table-striped listagem-vendas">
    <thead>
        <tr>
            <th>Codigo da venda</th>
            <th>Data</th>
            <th>Aluno</th>
            <th>Total</th>
            <th>Finalizada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vendas as $venda)
        <tr>
            <td>{{$venda->id}}</td>
            <td>{{$venda->data}}</td>
            <td>{{$venda->nome}}</td>
            <td>{{$venda->total}}</td>
            <td>
                @if ($venda->finalizada)
                    <span>Venda Salva</span> 
                @else
                    <span>Venda aberta</span>
                @endif
            </td>
        </tr>   
        @endforeach
    </tbody>
</table>

<input type="hidden" value="{{url('/')}}" id="url_vendas" name="url">

@endsection