@extends('layouts.masterAdmin')

@section ('content')
<h2> Mise à jour d'une information </h2>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('information.update', $info->idInformation) }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="col-md-4">
    <span class="plancher">Delta :</span>
  </div>
  <div class="col-md-8">
    <input type="text" name="deltaInformation" class="form-control" id="deltaInformation" value= <?php echo($info->deltaInformation) ?> data-rule="minlen:4" data-msg="Entrez une date valide" />
  </div>

  <div class="col-md-4">
    <span class="plancher">Nom :</span>
  </div>
  <div class="col-md-8">
    <textarea type="text" class="form-control" name="nameInformation" id="nameInformation" data-rule="minlen:4" data-msg="Entrez la description du message" rows="3" />
      <?php echo($info->nameInformation) ?>
    </textarea>
  </div>

  <div class="col-md-4">
    <span class="plancher">Type :</span>
  </div>
  <div class="col-md-8">
    <select class="form-control" id="typeInfoId" name="typeInfoId">
      @foreach($typeInfos as $typeInfo)
      <option value= "<?php echo($typeInfo->idTypeInfo) ?>" <?php if($info->typeInfoId == $typeInfo->idTypeInfo){?> selected="selected" <?php }?>>
        <?php echo($typeInfo->nameTypeInfo);?>
      </option>
      @endforeach
    </select>
  </div>

  <a href="{{ route('information.index') }}" class="btn btn-send" > Annuler </a>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

@endsection
