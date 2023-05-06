@extends('layouts.masterAdmin')

@section ('content')
<h2> Ajout de l'historique d'une information </h2>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('information.store') }}">
  {{ csrf_field() }}
  <div class="col-md-4">
    <label> Delta : </span>
  </div>
  <div class="col-md-8">
    <input type="text" name="deltaInformation" class="form-control" id="deltaInformation" data-rule="minlen:4" data-msg="Entrez un nombre " />
  </div>

  <div class="col-md-4">
    <label> Nom : </span>
  </div>
  <div class="col-md-8">
    <input type="text" class="form-control" name="nameInformation" id="nameInformation" data-rule="minlen:4" data-msg="Entrez un nom " />
  </div>

  <div class="col-md-4">
    <label> Type : </span>
  </div>
  <div class="col-md-8">
    <select class="form-control" id="typeInfoId" name="typeInfoId">
      @foreach($typeInfos as $typeInfo)
        <option value= "<?php echo($typeInfo->idTypeInfo)?>">
          <?php echo($typeInfo->nameTypeInfo);?>
        </option>
      @endforeach
    </select>
  </div>

  <a href="{{ route('information.index') }}" class="btn btn-send" > Annuler </a>
  <button type="submit" class="btn btn-primary"> Valider </button>
</form>

@endsection
