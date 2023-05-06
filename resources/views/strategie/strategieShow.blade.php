@extends('layouts.masterStrategie')

@section ('body')

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title> Stratégie </title>
      <link href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel = "stylesheet">
    </head>

    <body>
      <div class = "container" style="margin-top:20px;">
        <div class="panel panel-default"style="magin:40px;padding:20px">
          <h1>Résultats</h1>
          <div id="resultat" style="margin-top:40px;">
            <p style="color:black">Pour une décision prise le <b><?php echo $date?></b> , pour une livraison au 
              <b><?php echo $echeance?></b> et un prix de
              <b><?php echo $prix?></b> €/t 
              :</p>
            @foreach($resultats as $resultat) 
            <table class="table" style="background-color:#000000 ;color:white;">
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Prix obtenu avec la vente d'un contrat à terme</td>
                  <td>{{$resultat->prixVenteContrat}} </td> 
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Entre le prix du <?php echo $date?>, et le prix du <?php echo $echeance?>, 
                    les variations ont été telles que vous auriez du prévoir 
                    jusqu'à {{abs ($resultat->tresorieMin)}} € de trésorerie.</td>
                  <td> </td>
                </tr>

                <tr>
                  <th scope="row">3</th>
                  <td>Prix obtenu avec l'achat d'un put</td>
                  <td>{{$resultat->prixAchatPut}} </td>
                </tr>

                <tr>
                  <th scope="row">4</th>
                  <td>Meilleure stratégie (1) </td>
                  <td>{{$resultat->meileurSt}} </td>
                </tr>
             @endforeach
           </tbody>
          </table>
        </div>
      
          <center>
            <div class="row">
              <div class="col-md-6">
                  <a href="{{ route('strategie.index') }}" class="btn btn-success">Rejouer </a>
              </div>

              <div class="col-md-6">
                  <a href="/" class="btn btn-success">Accueil</a>
              </div></div>
          </center>
        </div>
        </div>
      </div>
      <div class = "container"> 
        <div class="panel panel-default" style="margin:40px;padding:20px">
          
          <p style="color:black"><b>(1)</b> La vente d'un contrat à terme revient à fixer un prix de 
              vente pour une date donnée, sans payer de prime. <br>
              
              En réalité vous ne choisissez pas le prix vous-même, mais vous choisissez 
              le jour où le prix du marché vous convient. <br>
              A l'échéance, vous obtiendrez le prix fixé.<br> 
              L'avantage est que le contrat à terme 
              ne nécessite pas le paiement d'une prime. <br>Cependant, pour utiliser
               les contrats à terme, il faut avoir de la trésorerie pour approvisionner 
               votre compte Euronext en fonction des variations de marché.
                 L'achat d'un put revient à payer une prime pour un prix 
                 donné et une date d'échéance donnée.<br> Cet achat vous permet 
                 de fixer votre prix, sans obligation. <br>Ainsi, vous avez jusqu'à 
                 la date d'échéance pour exercer votre option, c'est à dire profiter
                  du prix que vous avez fixé. <br>Si les prix du marché ne montent jamais
                   au dessus du prix que vous avez choisi, vous obtenez le prix choisi
                    diminué de la prime que vous avez du payer pour l'obtenir.<br> Si les 
                    prix du marché arrivent à un niveau supérieur à votre prix choisi,
                     vous pouvez profitez du prix de marché</p>

        </div>
      </div>
    </body>
    
  </html>

@endsection