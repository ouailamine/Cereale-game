@extends('layouts.masterAdmin')

@section ('content')
<h2> Ajout Administrateur </h2>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('administrateur.store') }}">
  {{ csrf_field() }}
  <div class="col-md-4">
    <label> Pseudo :</label>
  </div>
  <div class="col-md-8">
    <input type="text" name="pseudoUser" class="form-control" id="pseudoUser" data-rule="minlen:4" data-msg="Entrez un pseudonyme" />
  </div>

  <div class="col-md-4">
    <label> Email :</label>
  </div>
  <div class="col-md-8">
    <input type="email" name="email" class="form-control" id="email" data-rule="minlen:4" data-msg="Entrez une adresse email" />
  </div>

  <div class="col-md-4">
    <label> Mot de passe :</label>
  </div>
  <div class="col-md-8">
    <input type="password" class="form-control" name="password" id="password" data-rule="minlen:6" data-msg="Entrez un mot de passe" />
  </div>

  <div class="col-md-4">
    <label> Confirmer mot de passe :</label>
  </div>
  <div class="col-md-8">
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" data-rule="minlen:6" data-msg="Confirmez votre mot de passe" />
  </div>

  <a href="{{ route('administrateur.index') }}" class="btn btn-send" > Annuler </a>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

@endsection
