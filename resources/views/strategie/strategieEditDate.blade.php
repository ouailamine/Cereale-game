@extends('layouts.masterStrategie')

@section ('body')
<!DOCTYPE html>

<html>
  <head>
    <title> Stratégie date </title>
    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  </head>
<body>
    <div class = "container">
      <div class="panel panel-default">
        <center>
          <h1>Comparez les contrats à terme aux options</h1>
        </center>
        <center>
         <p style="text-align: center">Vous êtes producteur de blé et vous cherchez à vous prémunir
            contre une baisse des prix sur le marché et vous décidez de vous
            couvrir soit par la vente d’un contrat à terme, soit par l’achat d’un Put
        </p>
      </center>
        
        <form method="post" action="{{ route('strategie.echeance') }}" >
        {{ csrf_field() }}
        
        <div class="form-group">
          <center>
            <div id="dat">
              <h3><img src="../img/calendrier3.png" > Date</h3>
              <label for="sel1">Veuillez sélectionner une date : c'est la date à laquelle vous auriez pris la décision de vous couvrir</label><br>
              <input class="form-control" name="date" placeholder="Selectionner une date" style="width: auto; display: inline;" required/> <span > <i class="glyphicon glyphicon-th"></i></span>
              <br><br>
              <button type="submit" class="btn btn-success" id="valide"> Suivant</button>
            
          </center><br><br>
        </div>
      </form><br><br>

    </div>  
    </div>
   
    <script>
        ;(function($){
              $.fn.datepicker.dates['fr'] = {
              days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
              daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
              daysMin: ["di", "lu", "ma", "me", "ju", "vu", "sa"],
              months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
              monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
              today: "Aujourd'hui",
              monthsTitle: "Mois",
              clear: "Effacer",
          
              format: 'dd/mm/yyyy',
              };
              }(jQuery));
            $(document).ready(function(){
                var date_input=$('input[name="date"]'); 
                date_input.datepicker({
                
                  format: 'dd/mm/yyyy',
                    todayHighlight: true,
                    autoclose: true,
                    daysOfWeekDisabled: "0,6",
                    startDate: "17/10/2011",
                    startView: 2,
                    defaultViewDate: {year: '2011'},
                    clearBtn: true,
                    language: "fr",
                    orientation: "top right",
                    endDate: "20/02/2020",
                    datesDisabled: [
                    "01/11/2011","11/11/2011","25/12/2011",
                    "01/01/2012","08/04/2012","09/04/2012","01/05/2012","08/05/2012","17/05/2012","28/05/2012","27/05/2012","14/07/2012","15/08/2012","01/11/2012","11/11/2012","25/12/2012",
                    "01/01/2013","01/05/2013","08/05/2013","14/07/2013","15/08/2013","01/11/2013","11/11/2013","25/12/2013","31/03/2013","01/04/2013","19/05/2013","20/05/2013","09/05/2013",
                    "01/01/2014","01/05/2014","08/05/2014","14/07/2014","15/08/2014","01/11/2014","11/11/2014","25/12/2014","20/04/2014","21/04/2014","29/05/2014","08/06/2014","09/06/2014",
                    "01/01/2015","01/05/2015","08/05/2015","14/07/2015","15/08/2015","01/11/2015","11/11/2015","25/12/2015","05/04/2015","06/04/2015","14/05/2015","24/05/2015","25/05/2015",
                    "01/01/2016","01/05/2016","08/05/2016","14/07/2016","15/08/2016","01/11/2016","11/11/2016","25/12/2016","27/03/2016","28/03/2016","05/05/2016","16/05/2016","15/05/2016",
                    "01/01/2017","01/05/2017","08/05/2017","14/07/2017","15/08/2017","01/11/2017","11/11/2017","25/12/2017","17/04/2017","16/04/2017","25/05/2017","05/06/2017","04/06/2017",
                    "01/01/2018","01/05/2018","08/05/2018","14/07/2018","15/08/2018","01/11/2018","11/11/2018","25/12/2018","01/04/2018","02/04/2018","10/05/2018","20/05/2018","21/05/2018",
                    "01/01/2019","01/05/2019","08/05/2019","14/07/2019","15/08/2019","01/11/2019","11/11/2019","25/12/2019","21/04/2019","22/04/2019","30/05/2019","09/06/2019","10/06/2019",
                    "01/01/2020" ],
                })
            });
  </script>
    
  
  </body>

</html>
@endsection