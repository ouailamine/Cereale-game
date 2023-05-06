@extends('layouts.masterAdmin')

@section ('content')
<h2> Mise à jour des paramètres modifiables </h2>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<form method="post" action="{{ route('editableParameter.update', $editableParam->idParam) }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="col-md-3">
    <span> Plancher :</span>
  </div>
  <div class="col-md-9">
    <input name="plancher" class="form-control" id="plancher" value= <?php printf($editableParam->plancher) ?> data-rule="minlen:4"/>
  </div>

  <div class="col-md-3">
    <span> Plafond :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="plafond" id="plafond" value= <?php printf($editableParam->plafond) ?> data-rule="minlen:4" />
  </div>

  <div class="col-md-3">
    <span> Levier EBM :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="levierEBM" id="levierEBM" value= <?php printf($editableParam->levierEBM) ?> data-rule="minlen:4" />
  </div>

  <div class="col-md-3">
    <span> Nombre de periodes :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="nbrPeriodes" id="nbrPeriodes" value= <?php printf($editableParam->nbrPeriodes) ?> data-rule="minlen:4" />
  </div>

  <div class="col-md-3">
    <span> Quantité :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="quantite" id="quantite" value= <?php printf($editableParam->quantite) ?> data-rule="minlen:4" />
  </div>

  <div class="col-md-3">
    <span>Espérance du prix à terme :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="prixTermeEsperance" id="prixTermeEsperance" value= <?php printf($editableParam->prixTermeEsperance) ?> data-rule="minlen:4" />
  </div>

  <div class="col-md-3">
    <span> Ecart type du prix à terme : </span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="prixTermeEcartType" id="prixTermeEcartType" value= <?php printf($editableParam->prixTermeEcartType) ?> data-rule="minlen:4" />
  </div>

  <div class="col-md-3">
    <span> Espérance du prix spot : </span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="prixSpotEsperance" id="prixSpotEsperance" value= <?php printf($editableParam->prixSpotEsperance) ?> data-rule="minlen:4" data-msg="Entrez l'espérance du prix à spot valide" />
  </div>

  <div class="col-md-3">
    <span> Ecart type du prix spot :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="prixSpotEcartType" id="prixSpotEcartType" value= <?php printf($editableParam->prixSpotEcartType) ?> data-rule="minlen:4" data-msg="Entrez l'écart type du prix à spot valide" />
  </div>

  <div class="col-md-3">
    <span> Spread :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="spread" id="spread" value= <?php printf($editableParam->spread)?> data-rule="minlen:4" data-msg="Entrez un spread valide" />
  </div>

  <div class="col-md-3">
    <span> Lien vers le questionnaire :</span>
  </div>
  <div class="col-md-9">
    <input class="form-control" name="surveyLink" id="surveyLink" value= <?php printf($editableParam->surveyLink)?> data-rule="minlen:4" data-msg="Entrez un spread valide" />
  </div>

  <a href="{{ route('editableParameter.index') }}" class="btn btn-send" > Annuler </a>
  <button type="submit" class="btn btn-primary"> Valider</button>
</form>
<script>
    document.getElementById('levierEBM').addEventListener('input', function() {
      var levierEBM = document.getElementById('levierEBM').value;
      if (levierEBM == ""){
        document.getElementById("quantite").value = "";
      } else {
        document.getElementById("quantite").value = (levierEBM * 50)
      }
    });

    document.getElementById('quantite').addEventListener('input', function() {
      var quantite = document.getElementById('quantite').value;
      if (quantite == ""){
        document.getElementById("levierEBM").value = "";
      } else {
        document.getElementById("levierEBM").value = (quantite / 50)
      }
    });

</script>
@endsection
