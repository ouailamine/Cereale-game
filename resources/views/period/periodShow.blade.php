@extends('layouts.mail')

@section ('content')
  <div class="row">
    <h2> Bilan de la période
      @foreach($periods as $p)
        <?php if($p->idPeriod == $id){
          echo($p->numberPeriod);
         } ?>
      @endforeach
    </h2>

    @if(session()->get('success'))
    	 <div class="alert alert-success">
    		 {{ session()->get('success') }}
    	 </div>
    @endif
    <h3> Vous devez atteindre <?php echo($game->objectivePrice)?> euros </h3>
  </div>

                          @foreach($periods as $period)
                <?php if($period->idPeriod == $idMax){
                        if($period->numberPeriod == $nbrPeriodes and ($period->isSold === 0 || $period->isSold == 1)){?>
                          <a href="{{ route('bilan',[$game->idGame])}}">
                            <li><b>BILAN FINAL </b></li>
                          </a>
                        
                <?php   }else{ ?>
                          <a href="{{ route('period.edit', $game->idGame)}}">
                            <div id="newPeriod">Commencer la prochaine période </div>
                            <?php if($period->numberPeriod ==$nbrPeriodes){$isLast = true;}
                                  else {$isLast = false;}?>
                          </a>
              <?php     }
                      } ?>
              @endforeach
  <div class="row">
    <h3> Message </h3>
    <div class= "col-xs-2 col-md-1">
      <img src="{{ asset('img/man.png') }}" alt="Bootstrap" width="100%" height="100%">
    </div>
    <?php if($bilan->globalGap >=0){ ?>
    <div class= "col-xs-10 col-md-8 message-man-possitif">
      <?php echo($message->descriptionMessage)?>
    </div>
    <?php }else{ ?>
    <div class= "col-xs-10 col-md-8 message-man-negatif">
      <?php echo($message->descriptionMessage)?>
    </div>
    <?php } ?>
  </div>

  <div class ="row">
    <h3> Informations </h3>
      <?php if($informations != null ){ ?>
      <table class="table table-striped">
        <tbody>
          @foreach($informations as $information)
            <tr>
              <td>{{$information->nameInformation}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    <?php } ?>
  </div>

  <div class ="row">
    <h3> Vos choix </h3>
    @foreach($periods as $p)
      <?php if($p->idPeriod == $id){ ?>
      <p> <?php if ($p->isSold == 0 ) {echo("Vous n'avez pas accédé au  marché financier.");}
                else{
                  ?> <p>Vous avez accéder au marché financier 
                  <?php
                    if ($p->isSold !== 0 && $p->contratPosition > 0 ) {echo("et vous avez acheté ".$p->contratPosition." contrat");if($p->contratPosition > 1){echo("s");}}
                    if ($p->isSold !== 0 && $p->contratPosition == 0) { echo("mais vous n'avez rien fait.");}
                    if ($p->isSold !== 0 && $p->contratPosition < 0) { echo("et vous avez vendu ".$p->contratPosition*(-1)." contrat");if($p->contratPosition < 0){echo("s");}}} ?> 
               </p>
     
     
     <p> <?php if ($p->quantite == 0 ) {echo("Vous n'avez rien vendu sur le marché physique");} else{echo ("Vous avez vendu au marché physique " .$p->quantite. " tonnes");if($p->quantite < -1){echo("s");}}?> </p>
      <?php } ?>
    @endforeach
  </div>

  

  <div class ="row">
    <h3> Bilan </h3>
    <p> Prix à terme de cette période : <?php echo($bilan->priceTermPeriod);?> </p>
    <p> Prix ferme de cette période : <?php echo($bilan->priceSpotPeriod);?> </p>
    <p>Depuis le début, vous avez <?php if ($bilan->gainCumul >= 0) {echo("gagné ".$bilan->gainCumul);} else{echo"perdu ".$bilan->gainCumul;} ?>€ sur le MATIF</p>
    <p>Le prix ferme s’est éloigné de votre prix objectif de <?php echo($bilan->priceGap) ?>€.</p>
    <p>Avec votre résultat sur le MATIF, vous vous êtes éloignés de votre prix objectif de <?php echo($bilan->globalGap) ?>€.</p>
  </div>

<div style="width:400px;height:400px">
      <h3> Graphique synthèse </h3>
      <canvas id="myChart" style="width:30px;"></canvas>
      
</div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  
  <script>
    $(document).ready(function(){ 
    function FaireClignoter (){ $("#newMail").fadeOut(200).delay(300).fadeIn(300); } 
    setInterval(FaireClignoter,200); 
});

    // Récupération des périodes
    var periods = <?php echo json_encode($periods) ?>;
    var obj = [];
    var term = [];
    var spot = [];

    // Récupération de la listes des prix au cours des périodes
      periods.forEach(function(p) {
      obj.push(p['objectivePrice']);
      term.push(p['priceTermPeriod']);
      spot.push(p['priceSpotPeriod']);
    });

    // Création du graphique
    var ctx = document.getElementById('myChart').getContext('2d');
    var nbrPeriodes = <?php echo json_encode($nbrPeriodes);?>;
    let  numListPeriodes = [];
    for (let i = 1; i <= nbrPeriodes; i++) {numListPeriodes.push(i);}
    console.log(numListPeriodes);
    var labels = Array.from(numListPeriodes)
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
