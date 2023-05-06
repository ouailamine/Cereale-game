@extends('layouts.masterAdmin')

@section ('content')
<h2> Historique des prix termes </h2>
@if(session()->get('success'))
	 <div class="alert alert-success">
		 {{ session()->get('success') }}
	 </div>
@endif
<div class="col-md-2">
    <a href="{{ route('historicTerm.create') }}" class="btn btn-success">Ajouter</a>
</div>
<table class="table table-striped">
  <thead>
      <tr>
        <td>Date</td>
        <td>Prix Terme</td>
				<td>Modifier</td>
				<td>Supprimer</td>
      </tr>
  </thead>
  <tbody>
      @foreach($terms as $term)
      <tr>
          <td>{{$term->dateHistoricTermPrice}}</td>
          <td>{{$term->termPrice}}</td>
          <td><a href="{{ route('historicTerm.edit',$term->idHistoricTermPrice)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></a></td>
          <td>
                <form action="{{ route('historicTerm.destroy', $term->idHistoricTermPrice)}}" method="post">
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
