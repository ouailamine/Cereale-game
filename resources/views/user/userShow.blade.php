@extends('layouts.masterUser')

@section ('body')
  <h2> Bonjour <?php echo($pseudoUser);?></h2>

  @if(session()->get('success'))
  	 <div class="alert alert-success">
  		 {{ session()->get('success') }}
  	 </div>
  @endif

  <div class="container">
    <div class="col-md-8">
        <h3> Toutes vos parties </h3>
    </div>
    <div class="col-md-2">
        <a href="{{ route('game.edit', $id) }}" class="btn btn-success">Ajouter une partie </a>
    </div>

 </div>

  <table class="table table-striped">
  	<thead>
  			<tr>
  				<td> Nom </td>
  				<td> Prix objectif </td>
  				<td> Date de création </td>
  				<td> Afficher </td>
          <td> Bilan </td>
          <td> Rejouer </td>
  			</tr>
  	</thead>
  	<tbody>
  			@foreach($games as $game)
  			<tr>
  					<td>{{$game->nameGame}}</td>
  					<td>{{$game->objectivePrice}}</td>
  					<td>{{$game->dateGame}}</td>
  					<?php $alreadyDone = false; ?>
  					@foreach($periods as $period)
  					<?php
  					if($period->idGame == $game->idGame){
  						if ($period->numberPeriod==3){ ?>
  							<td><a href="{{ route('game.show',$game->idGame)}}" class="btn btn-success"><span class="glyphicon glyphicon-ok"></a></td>
                  <td> <a href="{{ route('bilan',$game->idGame)}}" class="btn btn-info"><span class="glyphicon glyphicon-search"></a></td>
                  <td> <a href="{{ route('replay',$game->idGame)}}" class="btn btn-primary"><span class="glyphicon glyphicon-play-circle"></a></td>
  					<?php $alreadyDone = true;
  						}
  					}
  					?>
  					@endforeach
  				<?php if(!$alreadyDone){ ?>
  					<td> <a class="btn btn-danger"><span class="glyphicon glyphicon-remove"></a></td>
              <td> </td>
              <td> </td>
  				<?php } ?>

  			</tr>
  			@endforeach
  	</tbody>
  </table>
@endsection
