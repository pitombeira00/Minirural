<ul id="_NavCadastro" class="dropdown-content">
      <li><a href="{{route('plano.home') }}">Plano de Contas</a></li>
      <li><a href="{{route('class.home') }} ">Classificação</a></li>
      <li><a href="{{route('lanca.home') }} ">Lançamentos</a></li>
  </ul>
  <!--menu 2-->
   <ul id="_NavMovimentacao" class="dropdown-content">
      <li><a href="{{route('fluxo.um')}}">Fluxo por Dia</a></li>
      <li><a href="{{route('fluxo.Para.anual')}}">Fluxo Anual</a></li>
      <li><a href="{{route('rel.para.dem')}}">Demonstrativo Geral</a></li>
    </ul>
<nav>
    <div class="nav-wrapper white">
        <div class="container">
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons purple lighten-3 ">menu</i></a>
         <a class="brand-logo purple-text">Mini Rural</a>
          <ul class="right hide-on-med-and-down">
            <li><a href="{{route('home') }} " class="deep-purple-text text-darken-2">Inicio</a></li>
            <li><a class="dropdown-button deep-purple-text text-darken-2" href="#!" data-activates="_NavCadastro">Cadastro<i class="material-icons right">arrow_drop_down</i></a></li>
            <li><a class="dropdown-button deep-purple-text text-darken-2" href="#!" data-activates="_NavMovimentacao">Relatórios<i class="material-icons right">arrow_drop_down</i></a></li>
         
          </ul>

             <ul id="mobile-demo" class="side-nav">
            <li><a href="{{route('home')}} " class="waves-effect"><i class="material-icons">home</i>Inicio</a></li>
              <li><div class="divider"></div></li>
              <li><a class="subheader"><i class="material-icons">contacts</i>Cadastros</a></li>
              <li><a href="{{route('plano.home') }}" class="waves-effect">Plano de Contas</a></li>
              <li><a href="{{route('class.home') }}" class="waves-effect">Classificação</a></li>
              <li><a href="{{route('lanca.home') }}" class="waves-effect">Lançamentos</a></li>
              <li><div class="divider"></div></li>
              <li><a class="subheader"><i class="material-icons">insert_chart</i>Relatórios</a></li>
              <li><a href="{{route('fluxo.um') }}" class="waves-effect">Fluxo por dia</a></li>
              <li><a href="{{route('fluxo.Para.anual') }}" class="waves-effect">Fluxo Anual</a></li>
              <li><a href="{{route('rel.para.dem') }}" class="waves-effect">Demonstrativo Geral</a></li>
              
            </ul>
          </div>
    </div>
</nav>


        