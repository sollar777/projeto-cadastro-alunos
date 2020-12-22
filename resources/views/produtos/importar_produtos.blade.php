@extends('layout.app')

@section('content')
    
    <form action="{{route('produtos.importar.csv')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <input type="file" name="csv" id="" class="form-control">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary form-control">Enviar</button>
            </div>
        </div>   
    </form>

@endsection