@extends('layouts.masterAdmin')


@section ('content')

<h2> Paramètres modifiables </h2>
@if(session()->get('success'))
	 <div class="alert alert-success">
		 {{ session()->get('success') }}
	 </div>
@endif

<div class="container">
	<span >Plancher :</span> <?php printf($editableParam->plancher) ?> <br>
	<span >Plafond :</span> <?php printf($editableParam->plafond) ?> <br>
	<span >Levier EBM :</span> <?php printf($editableParam->levierEBM) ?> <br>
	<span >Periodes par partie :</span> <?php printf($editableParam->nbrPeriodes) ?> <br>
	<span >quantité :</span> <?php printf($editableParam->quantite) ?> <br>
	<span >Espérance du prix à terme :</span> <?php printf($editableParam->prixTermeEsperance) ?><br>
	<span >Ecart type du prix à terme :</span> <?php printf($editableParam->prixTermeEcartType) ?> <br>
	<span >Espérance du prix spot :</span> <?php printf($editableParam->prixSpotEsperance) ?> <br>
	<span >Ecart type du prix spot :</span> <?php printf($editableParam->prixSpotEcartType) ?> <br>
	<span >Spread :</span> <?php printf($editableParam->spread) ?> <br>
	<span >Lien vers le questionnaire :</span> <?php printf($editableParam->surveyLink) ?> <br>
</div>
<br>
<div class="container">
	<a href="{{ route('editableParameter.edit',$editableParam->idParam) }}" class="btn btn-primary" > Modifier </a>
</div>
@endsection
