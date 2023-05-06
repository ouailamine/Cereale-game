@extends('layouts.masterAdmin')

@section ('content')
@if(session()->get('success'))
	 <div class="alert alert-success">
		 {{ session()->get('success') }}
	 </div>
@endif
<h2> Administrateur </h2>

<div class="container">
	<div class="col-md-4">
		<h3> Votre compte </h3> <br>
	</div>
</div>
<div class="container">
	<label> Pseudo : {{$user->pseudoUser}} </label> <br><br>
	<div class="col-md-2">
	    <a href="{{ route('administrateur.edit', $user->idUser) }}" class="btn btn-primary">Modifier son mot de passe</a>
	</div>
</div> <br>

<div class="container">
	<div class="col-md-4">
		<h3> Tous les administrateurs </h3>
	</div>

	<div class="col-md-2">
	    <a href="{{ route('administrateur.create') }}" class="btn btn-success">Ajouter</a>
	</div>
</div>

<div class="col-md-6">
	<table class="table table-striped">
	  <thead>
	      <tr>
	        <td> Pseudo </td>
	        <td> Supprimer </td>
	      </tr>
	  </thead>
	  <tbody>
	      @foreach($admins as $admin)
				<?php if($user->idUser != $admin->idUser){ ?>
		      <tr>
		          <td>{{$admin->pseudoUser}}</td>
		          <td>
		            <form action="{{ route('administrateur.destroy', $admin->idUser)}}" method="post">
		              {{ csrf_field() }}
		              {{ method_field('DELETE') }}
		              <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"> <span class="glyphicon glyphicon-trash"> </button>
		            </form>
		          </td>
		      </tr>
				<?php } ?>
	      @endforeach
	  </tbody>
	</table>
</div>

@endsection
