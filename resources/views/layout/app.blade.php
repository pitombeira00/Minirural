<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/materialize/dist/css/materialize.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <title>Mini Rural</title>

    
</head>
<body id="app-layout"  @if(Session::has('mensagem')) id="app-layout" onload="Materialize.toast('{{Session::get('mensagem')['msg']}}', 4000)" @endif>
  @include('layout.menu')

  <main>
    @yield('content')
  </main>
    

<footer class="page-footer deep-purple darken-4" >
  <div class="footer-copyright">
    <div class="container">
    Produto Mestrado em Extensão Rural - UNIVASF<br>
    Rita Costa, Orientação Denes Vieira <br> 
    2019 Copy Left, desenvolvido por <a href='http://www.valenext.com.br' >Danilo Pitombeira - danilo.pitombeira@valenext.com.br</a>
    </div>
    
  </div>
</footer>

    <script src="{{asset('lib/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('lib/materialize/dist/js/materialize.js')}}"></script>

    <script src="{{asset('js/consulta.js')}}"></script>
    <script src="{{asset('js/init.js')}}"></script>
</body>
</html>
