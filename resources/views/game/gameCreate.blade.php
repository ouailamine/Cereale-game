@extends('layouts.masterUser')

@section ('body')
  <h2> Nouvelle partie : </h2>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
  <br/>
  @endif


  <div class="container">
    <form method="post" action="{{ route('game.store') }}">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-4">
          <label> Choisissez un nom pour votre partie :</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="nameGame" class="form-control" id="nameGame" data-rule="minlen:4" data-msg="Entrez une date valide" style="width:auto;"/>
        </div>
        <div class="col-md-4" style="margin-top:15px">
          <label> Prix objectif : <a class="picto-item" aria-label="C'est le prix que vous souhaitez obtenir par tonne, il doit être compris entre 100 et 400 €/tonne. Tout au long du jeu vous devez tenter de l'obtenir ou le dépasser"><span class="glyphicon glyphicon-info-sign"></a></label>
        </div>
        <div class="col-md-8" style="margin-top:15px">
          <input type="number" min="100" max="400" class="form-control" name="objectivePrice" id="objectivePrice" data-rule="minlen:4" data-msg="Entrez prix valide" style="width:auto;" />
        </div>
      </div>
              
      <div class="row">
        <div class="col-md-6" style="margin-top:25px">
          <label> Prix à terme : <a class="picto-item" aria-label="Si vous vendez un contrat à terme, vous obtiendrez ce prix à la date de livraison."><span class="glyphicon glyphicon-info-sign"></a></label>
          <input class="form-control" name="termPrice" id="termPrice" readonly  />
        </div>
        <div class="col-md-6" style="margin-top:25px">
          <label> Prix ferme : <a class="picto-item" aria-label=" Si vous vendez votre récolte au physique, vous obtiendrez ce prix."><span class="glyphicon glyphicon-info-sign"></a></label>
          <input class="form-control" name="spotPrice" id="spotPrice" readonly/>
        </div>
      </div>

      <br/>

      <div class="row">
        <p style="color:red"><b> Avertissement : </b> nous ne sommes pas responsables de toute perte résultant de l'utilisation de ce jeu comme base pour vos opérations sur les marchés financiers. </p>
      </div>

      <div class="col-md-8">
        <input type="hidden" class="form-control" name="idUser" id="idUser" data-rule="minlen:4" value=<?php echo($id)?> data-msg="Entrez l'id d'un joueur" />
      </div>
      <?php if($idGame != null){?>
        <div class="col-md-8">
          <input type="hidden" class="form-control" name="idGame" id="idGame" data-rule="minlen:4" value=<?php echo($idGame)?> data-msg="Entrez l'id d'un joueur" />
        </div>
      <?php }?>

      <br/>

   <center><a href="{{ route('user.show',$id) }}" class="btn btn-send" > Annuler </a>
       <button type="submit" class="btn btn-primary">Valider</button></center>

    </form>
  </div>

  <script>
  console.log(nameGame)
    var plancher = <?php echo $plancher ?>;
    var plafond = <?php echo $plafond ?>;
    var spread = <?php echo $spread ?>;
    var termMean = <?php echo $termMean ?>;
    var spotMean = <?php echo $spotMean ?>;
    var termStd = <?php echo $termStd ?>;
    var spotStd = <?php echo $spotStd ?>;
    var rand1 = (Math.random() * (0.975 - 0.025) + 0.025).toFixed(4);
    var rand2 = (Math.random() * (0.975 - 0.025) + 0.025).toFixed(4);

    document.getElementById('objectivePrice').addEventListener('input', function() {
      var objectivePrice = document.getElementById('objectivePrice').value;
      if (objectivePrice == ""){
        document.getElementById("termPrice").value = "";
        document.getElementById("spotPrice").value = "";
      } else {
        document.getElementById("termPrice").value = (Math.min(Math.max(objectivePrice - spread + inv(rand1, termMean, termStd), plancher), plafond)).toFixed(2);
        document.getElementById("spotPrice").value = (parseFloat(document.getElementById("termPrice").value) + inv(rand2, spotMean, spotStd)).toFixed(2);
      }
    });

    function erfcinv(p) {
      var j = 0;
      var x, err, t, pp;
      if (p >= 2)
        return -100;
      if (p <= 0)
        return 100;
      pp = (p < 1) ? p : 2 - p;
      t = Math.sqrt(-2 * Math.log(pp / 2));
      x = -0.70711 * ((2.30753 + t * 0.27061) /
        (1 + t * (0.99229 + t * 0.04481)) - t);
      for (; j < 2; j++) {
        err = erfc(x) - pp;
        x += err / (1.12837916709551257 * Math.exp(-x * x) - x * err);
      }
      return (p < 1) ? x : -x;
    }

    function erfc(x) {
      return 1 - erf(x);
    }

    function erf(x) {
      var cof = [-1.3026537197817094, 6.4196979235649026e-1, 1.9476473204185836e-2,
        -9.561514786808631e-3, -9.46595344482036e-4, 3.66839497852761e-4,
        4.2523324806907e-5, -2.0278578112534e-5, -1.624290004647e-6,
        1.303655835580e-6, 1.5626441722e-8, -8.5238095915e-8,
        6.529054439e-9, 5.059343495e-9, -9.91364156e-10,
        -2.27365122e-10, 9.6467911e-11, 2.394038e-12,
        -6.886027e-12, 8.94487e-13, 3.13092e-13,
        -1.12708e-13, 3.81e-16, 7.106e-15,
        -1.523e-15, -9.4e-17, 1.21e-16,
        -2.8e-17
      ];
      var j = cof.length - 1;
      var isneg = false;
      var d = 0;
      var dd = 0;
      var t, ty, tmp, res;

      if (x < 0) {
        x = -x;
        isneg = true;
      }

      t = 2 / (2 + x);
      ty = 4 * t - 2;

      for (; j > 0; j--) {
        tmp = d;
        d = ty * d - dd + cof[j];
        dd = tmp;
      }

      res = t * Math.exp(-x * x + 0.5 * (cof[0] + ty * d) - dd);
      return isneg ? res - 1 : 1 - res;
    }

    function inv(p, mean, std) {
      return -1.41421356237309505 * std * erfcinv(2 * p) + mean;
    }
  </script>
@endsection
