@extends('layouts.masterAdmin')

@section ('content')
<h2> Historique des prix spots </h2>
@if(session()->get('success'))
	 <div class="alert alert-success">
		 {{ session()->get('success') }}
	 </div>
@endif

<div class="col-md-2">
    <a href="{{ route('historicSpot.create') }}" class="btn btn-success">Ajouter</a>
</div>
<table class="table table-striped">
  <thead>
      <tr>
        <td>Date</td>
        <td>Prix Spot</td>
        <td>Modifier</td>
				<td>Supprimer</td>
      </tr>
  </thead>
  <tbody>
      @foreach($spots as $spot)
      <tr>
          <td>{{$spot->dateHistoricSpotPrice}}</td>
          <td>{{$spot->spotPrice}}</td>
          <td><a href="{{ route('historicSpot.edit',$spot->idHistoricSpotPrice)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></a></td>
          <td>
                <form action="{{ route('historicSpot.destroy', $spot->idHistoricSpotPrice)}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><span class="glyphicon glyphicon-trash"></button>
                </form>
            </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection
