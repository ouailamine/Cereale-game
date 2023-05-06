@extends('layouts.masterAdmin')

@section ('content')
<h2> Affichage d'un message </h2>
<form method="post" action="{{ route('message.update', $message->idMessage) }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="col-md-4">
    <span class="plancher">Nom du message :</span>
  </div>
  <div class="col-md-8">
    <textarea disabled type="text" class="form-control" name="descriptionMessage" id="descriptionMessage" data-rule="minlen:4" data-msg="Entrez la description du message" rows="1" />
      <?php printf($message->nameMessage) ?>
    </textarea>
  </div>

  <div class="col-md-4">
    <span class="plancher">Description du message :</span>
  </div>
  <div class="col-md-8">
    <textarea disabled type="text" class="form-control" name="descriptionMessage" id="descriptionMessage" data-rule="minlen:4" data-msg="Entrez la description du message" rows="10" />
      <?php printf($message->descriptionMessage) ?>
    </textarea>
  </div>
  <div class="col-md-4">
    <label> Écart Global minimal :</span>
  </div>
  <div class="col-md-8">
    <input disabled class="form-control" name="ecartGlobalMin" value="<?php echo($message->ecartGlobalMin) ?>" id="ecartGlobalMin"  data-rule="minlen:4" />
  </div>
  <div class="col-md-4">
    <label> Écart Global maximal :</span>
  </div>
  <div class="col-md-8">
    <input disabled class="form-control" name="ecartGlobalMax" value="<?php echo($message->ecartGlobalMax) ?>" id="ecartGlobalMax"  data-rule="minlen:4" />
  </div>

  <a href="{{ route('message.index') }}" class="btn btn-send" > Annuler </a>
</form>

@endsection
