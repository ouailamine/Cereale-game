@extends('layouts.masterAdmin')

@section ('content')
<h2> Informations </h2>
@if(session()->get('success'))
	 <div class="alert alert-success">
		 {{ session()->get('success') }}
	 </div>
@endif
<div class="col-md-12">
    <a href="{{ route('information.create') }}" class="btn btn-success">Ajouter</a>
</div>
@foreach($typeInfos as $typeInfo)

	<h3> <?php echo($typeInfo->nameTypeInfo) ?> </h3>

	<table class="table table-striped">
	  <thead>
	      <tr>
					<div class="container">
						<td class="col-md-1"> Delta </td>
	        	<td class="col-md-9"> Nom </td>
						<td class="col-md-1"> Modifier </td>
	        	<!-- <td class="col-md-1" colspan="2"> Supprimer </td> -->
					</div>
	      </tr>
	  </thead>
	  <tbody>
	      @foreach($infos as $info)
				<?php if($info->typeInfoId == $typeInfo->idTypeInfo){?>
	      <tr>
	          <td>{{$info->deltaInformation}}</td>
	          <td>{{$info->nameInformation}}</td>
	          <td><a href="{{ route('information.edit',$info->idInformation)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></a></td>
						<!-- Vous ne pouvez pas supprimer une information -->
						<!--<td>
	                <form action="{{ route('information.destroy', $info->idInformation)}}" method="post">
	                  {{ csrf_field() }}
	                  {{ method_field('DELETE') }}
	                  <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
	                </form>
	            </td> -->
	      </tr>
				<?php } ?>
	      @endforeach
	  </tbody>
	</table>

@endforeach
@endsection
