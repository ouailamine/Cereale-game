@extends('layouts.masterUser')

@section ('body')
  <a href="{{ route('user.show', $id) }}" class="btn btn-send" > Retour </a>

  <center>
    <hr>
    <h1 style="background-color: gray;margin-bottom:20px;width:auto"> Bilan <?php echo($game->nameGame);?> </h1>
    <hr>
  </center>
          
  <center>
    <div style="height: auto;width:50%">
      <h3>Votre classement</h3>
      <h4>Classement partie :{{$gameranking+1}} sur <?php echo count($allgames); ?> </h4>
      <h4>Classement joueur :{{$playerranking+1}} sur <?php echo count($allgamesusers); ?> </h4>
    </div>
  </center>
  <hr style="background-color: gray">
  <?php
    $minLot = INF;
    $minGainCumul = INF;
    $maxLot = -1*INF;
    $maxGainCumul = -1*INF;
    $sommeLot = 0;
    $sommeGainCumul =0;
    $maxPrixVente = -1*INF;
    $gainCumulPeriodMax = null;
    $prixVente = null;
    $ecartTypeLot = 0;
    $ecartTypeGainCumul = 0;
    $vendu = false;
    $gainAchat = 0;
    $gainVente = 0;
    $perteAchat = 0;
    $perteVente = 0;
    $ancienGainCumul = 0;
  ?>
  
  <center>
    <div style="height: auto;width:50%">
      <h3> Tableau synthèse du jeu </h3>
      <table class="table table-striped">
        <thead>
            <tr>
              <td> Numéro période </td>
              <td> Prix terme </td>
              <td> Prix Spot </td>
              <td> Prix objectif </td>
              <td> Prix de vente </td>
            </tr>
        </thead>
        <tbody>
            @foreach($periods as $period)
            <?php

            if($period->contratPosition < $minLot){
              $minLot = $period->contratPosition;
            }
            if($period->gainCumul < $minGainCumul){
              $minGainCumul = $period->gainCumul;
            }
            if($period->contratPosition > $maxLot){
              $maxLot = $period->contratPosition;
            }
            if($period->gainCumul > $maxGainCumul){
              $maxGainCumul = $period->gainCumul;
            }
            if($period->priceSpotPeriod > $maxPrixVente){
              $maxPrixVente = $period->priceSpotPeriod;
            }
            $sommeLot += $period->contratPosition;
            $sommeGainCumul += $period->gainCumul;
            if($period->numberPeriod == 3){
              $gainCumulPeriodMax = $period->gainCumul;
            }
            if($period->isSold == 1){
              $prixVente = $period->priceSpotPeriod;
              $vendu = true;
            }
            ?>
            <tr>
                <td>{{$period->numberPeriod}}</td>
                <td>{{$period->priceTermPeriod}}</td>
                <td>{{$period->priceSpotPeriod}}</td>
                <td>{{$game->objectivePrice}}</td>
                <td><?php if(!$vendu){
                  echo("");
                }else{
                  echo($prixVente);
                  }
                ?></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </center>
  <hr>
  
  <center>
    <div style="height: auto;width:50%">
      <h3> Graphique synthèse du jeu </h3>
      <canvas id="myChart"></canvas>
      <!-- Calcul écart type -->
      <?php foreach ($periods as $period ) {
        $ecartTypeLot += ($period->contratPosition - ($sommeLot/3)) * ($period->contratPosition - ($sommeLot/3));
        $ecartTypeGainCumul += ($period->gainCumul - ($sommeGainCumul/3)) * ($period->gainCumul - ($sommeGainCumul/3));

        $ecartTypeLot = sqrt($ecartTypeLot/3);
        $ecartTypeGainCumul = sqrt($ecartTypeGainCumul/3);
      }?>
    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
      <h3> Exposition au risque </h3>
      <table class="table table-striped">
        <thead>
            <tr>
              <th> Exposition au risque </th>
              <th> Moyenne </th>
              <th> Écart type </th>
              <th> Min </th>
              <th> Max </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> La somme des pertes et profits </td>
                <td> <?php echo(number_format($sommeGainCumul/3,2,'.','')); ?> </td>
                <td> <?php echo(number_format($ecartTypeGainCumul,2,'.','')); ?> </td>
                <td> <?php echo($minGainCumul); ?> </td>
                <td> <?php echo($maxGainCumul); ?> </td>
            </tr>
            <tr>
                <td>Lots</td>
                <td> <?php echo(number_format($sommeLot/3,2,'.','')); ?> </td>
                <td> <?php echo(number_format($ecartTypeLot,2,'.','')); ?> </td>
                <td> <?php echo($minLot); ?> </td>
                <td> <?php echo($maxLot); ?> </td>
            </tr>
        </tbody>
      </table>
    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
      <div class="container-fluid">
        <div class= "col-md-2 col-sm-2">
          <img src="{{ asset('img/man.png') }}" alt="Bootstrap" width="100%" height="100%">
        </div>
        <div class= "col-md-10 col-sm-10 message-man-bilan">
          <?php if($sommeLot/3 < -1.5){ ?>
            <h3> Vous êtes un speculateur à la baisse </h3>
          <?php }elseif ($sommeLot/3 < -0.5) { ?>
            <h3> Vous êtes un hedger </h3>
          <?php }elseif($sommeLot/3 < 0.5){ ?>
            <h3> Vous avez un comportement neutre </h3>
          <?php }else{ ?>
            <h3> Vous êtes un speculateur à la hausse </h3>
          <?php } ?>
        </div>
      </div>

    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
      <h3> Perte/Profit </h3>
      <table class="table table-striped">
        <thead>
            <tr>
              <td> Numéro période </td>
              <td> La somme des pertes et profits </td>
              <td> Lots </td>
              <td> Pertes et profits par période </td>
            </tr>
        </thead>
        <tbody>
            @foreach($periods as $period)
            <tr>
                <td>{{$period->numberPeriod}}</td>
                <td>{{$period->gainCumul}}</td>
                <td>{{$period->contratPosition}}</td>
                <td><?php echo(number_format(($period->gainCumul - $ancienGainCumul),2,'.','')); ?></td>
            </tr>
            <?php
              if( ($period->gainCumul - $ancienGainCumul)>0 && $period->contratPosition>0){
                $gainAchat += 1;
              }
              if( ($period->gainCumul - $ancienGainCumul)>0 && $period->contratPosition<0 ){
                $gainVente += 1;
              }
              if( ($period->gainCumul - $ancienGainCumul)<0 && $period->contratPosition>0 ){
                $perteAchat += 1;
              }
              if( ($period->gainCumul - $ancienGainCumul)<0 && $period->contratPosition<0 ){
                $perteVente += 1;
              }
              $ancienGainCumul = $period->gainCumul;
            ?>
            @endforeach
        </tbody>
      </table>
    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
      <h3> Mesure de performance à terme </h3>
      <table class="table table-striped">
        <thead>
            <tr>
              <th>  </th>
              <th> Gain </th>
              <th> Perte </th>
              <th> ∑ </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Achat</td>
                <td> <?php echo($gainAchat); ?> </td>
                <td> <?php echo($perteAchat); ?> </td>
                <td> <?php echo($gainAchat + $perteAchat); ?> </td>
            </tr>
            <tr>
                <td>Vente</td>
                <td> <?php echo($gainVente); ?> </td>
                <td> <?php echo($perteVente); ?> </td>
                <td> <?php echo($gainVente + $perteVente); ?> </td>
            </tr>
            <tr>
                <td>∑</td>
                <td> <?php echo($gainAchat + $gainVente); ?> </td>
                <td> <?php echo($perteAchat + $perteVente); ?> </td>
                <td> <?php echo($perteAchat + $perteVente + $gainAchat + $gainVente); ?> </td>
            </tr>
        </tbody>
      </table>
    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
      <h3> Bilan des décisions prises </h3>
      <table class="table table-striped">
        <thead>
            <tr>
              <td> Prix Vente réalisé </td>
              <td> <?php echo($prixVente);?> </td>
              <td> <?php echo(number_format($prixVente/$game->objectivePrice*100,2,'.',''));?> % </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">Pendant la campagne, vous avez <?php if($gainCumulPeriodMax>=0){echo("gagné ");}else{echo("perdu ");}?> <label> <?php echo($gainCumulPeriodMax);?> € </label> sur le MATIF.</td>
                <td> <?php echo(number_format($gainCumulPeriodMax/$game->objectivePrice*100,2,'.',''));?> %</td>
            </tr>
            <tr>
                <td>Prix objectif</td>
                <td> <?php echo($game->objectivePrice) ?></td>
                <td> 100 %</td>
            </tr>
            <tr>
                <td>Objectif atteint à</td>
                <td> <?php echo($gainCumulPeriodMax + $prixVente - $game->objectivePrice);?> </td>
                <td> <?php echo(number_format(($gainCumulPeriodMax + $prixVente - $game->objectivePrice)/$game->objectivePrice*100,2,'.',''));?> %</td>
            </tr>
        </tbody>
      </table>

    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">

      <h3> Mesure de performance en spot </h3>
      <table class="table table-striped">
        <tbody>
            <tr>
                <td> Prix de vente en spot</td>
                <td> <?php echo($prixVente);?></td>
            </tr>
            <tr>
                <td> Max prix de vente </td>
                <td> <?php echo($maxPrixVente);?> </td>
            </tr>
            <tr>
                <td>Perte d'opportunité </td>
                <td> <?php $perteOp = (1-$prixVente/$maxPrixVente)*100;
                          echo(number_format($perteOp,2,'.',''));?> % </td>
            </tr>
        </tbody>
      </table>
    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
      <h3> Mesure de performance à terme </h3>
      <table class="table table-striped">
        <thead>
            <tr>
              <th>  </th>
              <th> Gain </th>
              <th> Perte </th>
              <th> ∑ </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Achat</td>
                <td> <?php echo($gainAchat); ?> </td>
                <td> <?php echo($perteAchat); ?> </td>
                <td> <?php echo($gainAchat + $perteAchat); ?> </td>
            </tr>
            <tr>
                <td>Vente</td>
                <td> <?php echo($gainVente); ?> </td>
                <td> <?php echo($perteVente); ?> </td>
                <td> <?php echo($gainVente + $perteVente); ?> </td>
            </tr>
            <tr>
                <td>∑</td>
                <td> <?php echo($gainAchat + $gainVente); ?> </td>
                <td> <?php echo($perteAchat + $perteVente); ?> </td>
                <td> <?php echo($perteAchat + $perteVente + $gainAchat + $gainVente); ?> </td>
            </tr>
        </tbody>
      </table>
    </div>
  </center>
  <hr>
  <center>
    <div style="height: auto;width:50%">
          <a href="{{ route('replay',[$game->idGame]) }}" class="btn btn-success"> Rejouer la partie </a>
          <a href=<?php echo($surveyLink); ?> class="btn btn-warning"> Répondre au questionnaire </a>
     
    </div>
  </center>
  <hr>


  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script>
    // Récupération des périodes
    var periods = <?php echo json_encode($periods) ?>;
    var obj = [];
    var term = [];
    var spot = [];

    // Récupération de la listes des prix au cours des périodes
    periods.forEach(function(p) {
      obj.push(<?php echo $game->objectivePrice ?>);
      term.push(p['priceTermPeriod']);
      spot.push(p['priceSpotPeriod']);
    });

    // Création du graphique
    var ctx = document.getElementById('myChart').getContext('2d');
    var nbrPeriodes = <?php echo json_encode($nbrPeriodes);?>;
    let  list = '';
    for (let i = 1; i <= nbrPeriodes; i++) {list = list + i;}
    console.log(list);
    var labels = Array.from(list)
    console.log(labels);
 
    var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',

      // The data for our dataset
      data: {
          labels,
          datasets: [
            {
              label: 'Prix objectif',
              fill:false,
              backgroundColor: 'rgb(99, 255, 132)',
              borderColor: 'rgb(99, 255, 132)',
              data: obj
            },
            {
              label: 'Prix à terme',
              fill:false,
              backgroundColor: 'rgb(99, 132, 255)',
              borderColor: 'rgb(99, 132, 255)',
              data: term
            },
            {
              label: 'Prix ferme',
              fill:false,
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: spot
            }
          ]
      },

      // Configuration options go here
      options: {}
    });
  </script>

@endsection
