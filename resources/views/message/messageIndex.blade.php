@extends('layouts.masterAdmin')

@section ('content')
<h2> Messages </h2>
<p class="txt-para">
	Attention !! L'écart global minimum d'un message doit être égal à l'écart global maximum du message juste en dessous !! (Sauf pour le message par défaut)

</p>
@if(session()->get('success'))
	 <div class="alert alert-success">
		 {{ session()->get('success') }}
	 </div>
@endif
<div class="col-md-2">
    <a href="{{ route('message.create') }}" class="btn btn-success"> Ajouter </a>
</div>
<table class="table table-striped">
  <thead>
      <tr>
				<td> Nom </td>
				<td> Écart global minimum </td>
				<td> Écart global maximum </td>
				<td> Afficher </td>
				<td> Modifier </td>
				<!--<td> Supprimer </td> -->
      </tr>
  </thead>
  <tbody>
      @foreach($messages as $message)
      <tr>
          <td>{{$message->nameMessage}}</td>
					<td>{{$message->ecartGlobalMin}}</td>
					<td>{{$message->ecartGlobalMax}}</td>
          <td><a href="{{ route('message.show',$message->idMessage)}}" class="btn btn-info"> <span class="glyphicon glyphicon-search"> </a></td>
          <td><a href="{{ route('message.edit',$message->idMessage)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-pencil"> </a></td>
					<?php if ($message->nameMessage !='Défaut') {?>
          <!--<td>
                <form action="{{ route('message.destroy', $message->idMessage)}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"> <span class="glyphicon glyphicon-trash"> </button>
                </form>
            </td> -->
					<?php }else{?>
						<td>  </td>
					<?php }; ?>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection
