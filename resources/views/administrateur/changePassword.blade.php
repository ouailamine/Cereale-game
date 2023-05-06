@extends('layouts.masterUser')

@section ('content')
<h2> Modification du mot de passe </h2>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('administrateur.update', $id) }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  <div class="col-md-4">
    <label> Ancien mot de passe :</label>
  </div>
  <div class="col-md-8">
    <input type="password" name="current_password" class="form-control" id="current_password" data-rule="minlen:4" />
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
