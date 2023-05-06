<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/mail.css') }}"  />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"  />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="img/cerealeLogo.png"  />
  <script src="{{ asset('js/admin.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

@show
</head>
<body>

      <div class="col-sm-4 col-md-4">
        <div class="nav-side-menu">
          <div class="brand"><img src="{{ asset('img/logo.png') }}" height="15%" width="15%"/> C-REAL MAIL</div>
          <a href="{{ route('user.show',$game->userId)}}" onclick="return confirm('Si vous quittez une partie en cours vous ne pourrez pas la continuer plus tard. Êtes-vous sûr de vouloir quitter ?')"><div class="brand" style="color:red"> <span class="glyphicon glyphicon-remove-sign"><span> Quitter </div></a>
          <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
          <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">
              @foreach($periodsMail as $period)
                <?php if($period->idPeriod == $idMax){
                        if($period->numberPeriod == $nbrPeriodes and ($period->isSold === 0 || $period->isSold == 1)){?>
                          <a href="{{ route('bilan',[$game->idGame])}}">
                            <div style="height: 35px"><li id="bilanF"><b>BILAN FINAL </b></li></div>
                          </a>
                          <a href="{{ route('period.show',$period->idPeriod)}}">
                            <li> Bilan de la période {{$period->numberPeriod}}</li>
                          </a>
                <?php   }else{ ?>
                          <a href="{{ route('period.edit', $game->idGame)}}">
                            <div id="mail">
                              Jouer une Nouvelle période
                              <span id="newMail" style="display: none;"> 1 </span>
                            </div>

                            <?php if($period->numberPeriod == $nbrPeriodes){$isLast = true;}
                                  else {$isLast = false;}?>
                          </a>
              <?php     }
                      }else{ ?>
                        <?php
                        if($period->idPeriod != $idMax || $numMax == $nbrPeriodes){?>
                              <a href="{{ route('period.show',$period->idPeriod)}}">
                                <li> Bilan de la période {{$period->numberPeriod}}</li>
                              </a>
                        <?php } ?>
                      <?php  } ?>
              @endforeach
                <a href="{{ route('game.show',$game->idGame)}}">
                  <li> Décision initiale </li>
                </a>
            </ul>
         </div>
       </div>
     </div>

     <div class="col-md-8 col-sm-8">
        @yield('content')
     </div>
<script>
$(document).ready(function(){ 
    function FaireClignoter (){ $("#bilanF").fadeOut(200).delay(300).fadeIn(300); } 
    setInterval(FaireClignoter,200); 
});

</script>

</body>



