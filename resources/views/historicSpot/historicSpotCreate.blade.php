@extends('layouts.masterAdmin')

@section ('content')
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif

<h2> Ajout de l'historique d'un prix spot </h2> <br>

<form method="post" action="{{ route('historicSpot.store') }}">
  {{ csrf_field() }}
  <div class="container">
    <div class="col-md-2">
      <label> Date :</label>
    </div>
    <div class="col-md-2 ">
      <input type="date" name="dateHistoricSpotPrice" class="form-control" id="dateHistoricSpotPrice" data-rule="minlen:4" data-msg="Entrez une date valide" />
    </div>
    <div class="col-md-3">
      <span> Format AAAA-MM-JJ </span>
    </div>
  </div>

  <br>

  <div class="container">
    <div class="col-md-2">
      <label> Prix spot :</label>
    </div>
    <div class="col-md-2">
      <input name="spotPrice" id="spotPrice" data-rule="minlen:4" data-msg="Entrez prix valide" />
    </div>
  </div>

  <br>

  <div class="container">
    <div class="col-md-2">
      <a href="{{ route('historicSpot.index') }}" class="btn btn-send" > Annuler </a>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary">Valider</button>
    </div>
  </div>
</form>

@endsection
