@extends('layouts.masterStrategie')

@section ('body')

<!DOCTYPE html>
<html>
  <head>
    <title> Stratégie echeance </title>
  </head>
  <body>
    <div class = "container">
      <div class="panel panel-default">
        <form method="post" action="{{ route('strategie.prix') }}" >
          {{ csrf_field() }}
        <center>
          <div id="echeance" style="margin-top:50px;">
            <h3><img src="../../img/calendrier2.png"> Echéance</h3>
            <label >Veuillez sélectionner une échéance : c'est la date à laquelle vous auriez voulu 
              livrer votre marchandise</label><br>
            <select class="form-control" id="echeance" name="echeance" 
             style="width: auto; display: inline;" required>
              <option value=""> -- Selectionner --</option>
              @foreach($echeances as $echeanceFr)
              <option>{{$echeanceFr->echeanceFr}}</option>
              @endforeach
            </select><br><br>
            <button type="submit" class="btn btn-success" id="valide2"> suivant</button>
          </div>
        </center><br><br>
      </form><br><br>
    </div>
  </div>
  </body>
  </html>
@endsection