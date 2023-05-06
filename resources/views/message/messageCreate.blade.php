@extends('layouts.masterAdmin')

@section ('content')
<h2> Nouveau message </h2>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('message.store') }}">
  {{ csrf_field() }}
  <div class="col-md-4">
    <label> Nom du message :</span>
  </div>
  <div class="col-md-8">
    <input type="text" name="nameMessage" class="form-control" id="nameMessage" data-rule="minlen:4" data-msg="Entrez le nom du message valide" />
  </div>

  <div class="col-md-4">
    <label> Description du message :</span>
  </div>
  <div class="col-md-8">
    <textarea type="text" class="form-control" name="descriptionMessage" id="descriptionMessage" data-rule="minlen:4" data-msg="Entrez la description du message" rows="10" />
    </textarea>
  </div>
  <div class="col-md-4">
    <label> Écart global minimal :</span>
  </div>
  <div class="col-md-8">
    <input class="form-control" name="ecartGlobalMin" id="ecartGlobalMin"  data-rule="minlen:4" />
  </div>
  <div class="col-md-4">
    <label> Écart global maximal :</span>
  </div>
  <div class="col-md-8">
    <input class="form-control" name="ecartGlobalMax" id="ecartGlobalMax"  data-rule="minlen:4" />
  </div>

  <a href="{{ route('message.index') }}" class="btn btn-send" > Annuler </a>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

@endsection
