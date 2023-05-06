<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}"  />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"  />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="{{ asset('js/admin.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="icon" type="image/png" href="img/cerealeLogo.png"  />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">C-REAL GAME</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ route('editableParameter.index') }}"> Paramètres </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="{{ route('historicTerm.index') }}"> Prix terme </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="{{ route('historicSpot.index') }}"> Prix spot </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="{{ route('information.index')}}"> Informations </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="{{ route('message.index')}}"> Messages </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/users/logout"> <span class="glyphicon glyphicon-log-out"> Déconnexion </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('administrateur.index')}}"> <span class="glyphicon glyphicon-user"> Administrateurs </a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


  @show
</head>
<body>
  <div class="container">
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>


</html>
