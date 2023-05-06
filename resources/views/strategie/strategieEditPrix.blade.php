@extends('layouts.masterStrategie')

@section ('body')

<!DOCTYPE html>
<html>
  <head>
    <title> Stratégie prix </title>
  </head>
  <body>    
    <div class = "container">
      <div class="panel panel-default">
        <form method="post" action="{{ route('strategie.resultats') }}">
        {{ csrf_field() }}
        <center> 
          <div id="prix" style="margin-top:50px;">
            <h3> <img src="../../img/prix2.png" >Prix</h3>
            <label for="sel1">Veuillez sélectionner le prix que vous souhaitez obtenir.</label><br>
            <select class="form-control" id="prix" name="prix" style="width: auto; display: inline;" required>
              <option value=""> -- Selectionner--</option>
              @foreach($prixx as $p)
              <option>{{$p->prix}}</option>
              @endforeach
            </select><br><br>
            <button type="submit" class="btn btn-success" id="valide"> Valider</button>
          </div>
        </center><br><br>
      </form><br><br>
    </div>
  </div>
  </body>

</html>
@endsection