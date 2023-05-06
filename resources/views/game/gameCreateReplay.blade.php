@extends('layouts.masterUser')

@section ('body')
  <h2> Nouvelle partie : </h2>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
  <br/>
  @endif


  <form method="post" action="{{ route('game.store') }}">
    {{ csrf_field() }}
    <div class="col-md-4">
      <label> Choisissez un nom pour votre partie :</label>
    </div>

    <div class="col-md-8">
      <input type="text" name="nameGame" class="form-control" id="nameGame" data-rule="minlen:4" data-msg="Entrez une date valide" />
    </div>

    <div class="col-md-4">
      <label> Prix objectif : <a class="picto-item" aria-label="C’est le prix auquel vous souhaitez vendre votre récolte. Il doit être cohérent avec les prix des années passées, mais aussi avec vos besoins de trésorerie. Tout au long du jeu, vous allez tenter de l’obtenir ou de le dépasser."><span class="glyphicon glyphicon-info-sign"></a></label>
    </div>
    <div class="col-md-8">
      <input type="text" class="form-control" name="objectivePrice" id="objectivePrice" value="<?php echo($game->objectivePrice)?>" data-rule="minlen:4" data-msg="Entrez prix valide" readonly />
    </div>

    <div class="col-md-6">
      <label> Prix à terme : <a class="picto-item" aria-label="C’est le prix du contrat à terme sur le MATIF pour la date de livraison souhaitée, sachant qu’un contrat est équivalent à votre récolte."><span class="glyphicon glyphicon-info-sign"></a></label>
      <input class="form-control" value="<?php echo($game->priceTermGame);?>" name="termPrice"  readonly/>
    </div>
    <div class="col-md-6">
      <label> Prix ferme : <a class="picto-item" aria-label="C’est le prix net départ ferme, le prix sur marché physique que vous obtiendrez après avoir vendu votre récolte."><span class="glyphicon glyphicon-info-sign"></a></label>
      <input class="form-control" value="<?php echo($game->priceSpotGame);?>" name="spotPrice" readonly/>
    </div>

    <div class="col-md-8">
      <input type="hidden" class="form-control" name="idUser" id="idUser" data-rule="minlen:4" value="<?php echo($game->userId)?>" data-msg="Entrez l'id d'un joueur" />
    </div>
    <?php if($idGame != null){?>
      <div class="col-md-8">
        <input type="hidden" class="form-control" name="idGame" id="idGame" data-rule="minlen:4" value="<?php echo($idGame)?>" data-msg="Entrez l'id d'un joueur" />
      </div>
    <?php }?>
    <br>
    <br>
  </div>
    <div class="container">
      <div class="col-md-1 col-sm-1">
        <a href="{{ route('user.show',$id) }}" class="btn btn-send" > Annuler </a>
      </div>
      <div class="col-md-1 col-sm-1">
        <button type="submit" class="btn btn-primary">Valider</button>
      </div>
    </div>

  </form>


@endsection
