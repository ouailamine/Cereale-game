@extends('layouts.masterStrategie')

@section ('body')
<!DOCTYPE html>

<html>
  <head>
    <title> Bienvenue en stratégie </title>
    
</head>
<body>
    <div class = "container">
        <div class="panel panel-default">
            <center>
                <h1>Comparer différentes stratégies de couverture</h1></center><br><br>
            <div class="row">
        <center><div class="col-md-12">
            <p>Nous nous mettons en situation dans le passé : 
                vous êtes producteur de blé et vous cherchez à
                vous prémunir contre une baisse des prix sur le marché.
            </p> 
            <p>Vous décidez de vous couvrir soit par la vente d’un contrat à terme, 
                c'est à dire un contrat qui va vous permettre de fixer votre prix de 
                vente à l'avance sans pouvoir profiter d'une hausse des prix si elle a lieu 
                ; ou par l’achat d’une option Put.
            </p>
            <p> L'option put permet, après paiement 
                d'une prime, de fixer un prix de vente à l'avance mais laisse la possibilité
                de profiter d'une éventuelle hausse des prix.
            </p>
        </div></center>
    </div><br><br>
    <center>
      <a href="{{ route('strategie.date') }}" class="btn btn-submit" style="margin-bottom: 20px">Commencer </a><br>
      </center>
    </div>
</div>
    
    
  
  </body>

</html>
@endsection