@extends('layouts.masterAdmin')

@section ('content')
<h2> Ajout de l'historique d'un prix terme </h2> <br>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('historicTerm.store') }}">
  {{ csrf_field() }}
  <div class="container">
    <div class="col-md-2">
      <label> Date :</label>
    </div>
    <div class="col-md-2">
      <input type="date" name="dateHistoricTermPrice" class="form-control" id="dateHistoricTermPrice" data-rule="minlen:4" data-msg="Entrez une date valide" />
    </div>
    <div class="col-md-3">
      <span> Format AAAA-MM-JJ</span>
    </div>
  </div>
  <br>

  <div class="container">
    <div class="col-md-2">
      <label> Prix à terme :</label>
    </div>
    <div class="col-md-2">
      <input class="form-control" name="termPrice" id="termPrice" data-rule="minlen:4" data-msg="Entrez prix valide" />
    </div>
  </div>

  <br>

  <div class="container">
    <div class="col-md-2">
      <a href="{{ route('historicTerm.index') }}" class="btn btn-outline-primary" > Annuler </a>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary">Valider</button>
    </div>
  </div>
</form>

@endsection
