@extends('layouts.masterAdmin')

@section ('content')
<h2> Mise à jour de historique d'un prix terme </h2> <br>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('historicTerm.update', $term->idHistoricTermPrice) }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  <div class="container">
    <div class="col-md-2">
      <label class="plancher">Date :</label>
    </div>
    <div class="col-md-2">
      <input type="text" name="dateHistoricTermPrice" class="form-control" id="dateHistoricTermPrice" value= <?php printf($term->dateHistoricTermPrice) ?> data-rule="minlen:4" data-msg="Entrez une date valide" />
    </div>
    <div class="col-md-3">
      <span> Format AAAA-MM-JJ </span>
    </div>
  </div>

  <br>

  <div class="container">
    <div class="col-md-2">
      <label class="plancher">Prix à terme :</label>
    </div>
    <div class="col-md-2">
      <input class="form-control" name="termPrice" id="termPrice" value= <?php printf($term->termPrice) ?> data-rule="minlen:4" data-msg="Entrez prix valide" />
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
