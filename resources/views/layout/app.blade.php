<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">

    <title>ProjetoY</title>
</head>
<body>
    
    <div class="container">
        @yield('content')
    </div>

    <script src="{{asset('jquery.js')}}"></script>
    <script src="{{asset('bootstrap.js')}}"></script>
    <script src="{{asset('funcoes/jquery_mask.js')}}"></script>
    <script src="{{asset('vendas/vendas.js')}}"></script>
    <script src="{{asset('funcoes/buscarCep.js')}}"></script>

</body>
</html>