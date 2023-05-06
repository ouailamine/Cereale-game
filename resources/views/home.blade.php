@extends('layouts/homePage')

@section('body')
  <!--header-->
  <header class="main-header" id="header">
    <div class="bg-color">
      <!--nav-->
      <nav class="nav navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                            <span class="fa fa-bars"></span>
                        </button>
              <a href="/" class="navbar-brand">C-Real Game </a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="mynavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#header">Accueil</a></li>
                <!--<li><a href="#feature">Instructions</a></li>-->
                <li><a href="#portfolio">Partenariats</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!--/ nav-->
      <div class="container text-center">
        <div class="wrapper wow fadeInUp delay-05s">
          <h3 class="title">C-Real Game</h3>
          <h4 class="sub-title">Serious game pour agriculteurs céréaliers</h4>
          
          <button id="showGames" class="btn btn-submit" style="margin-bottom: 50px">Jouer maintenant </button><br>

          <div id="games" style="display: none;">
            <div class="row">
              <div class="col-md-6">
                    @guest
                      <a href="{{ route('login') }}" class="btn btn-submit">JOUER MAINTENANT <br>A LA SIMULATION</a>
                    @else
                      @auth('admin')
                        <a href="{{ route('editableParameter.index') }}" class="btn btn-submit">JOUER MAINTENANT A LA SIMULATION</a>
                      @else
                        <a href="{{ route('user.show', auth()->id()) }}" class="btn btn-submit">JOUER MAINTENANT A LA SIMULATION</a>
                      @endauth
                    @endguest
                    <br><button id="showGuide1" class="btn btn-submit" >Mode d'emploi </button>
              </div>
              <div class="col-md-6">
                    <a href="{{ route('strategie.index') }}" class="btn btn-submit">COMPARER DIFFÉRENTES <br> STRATÉGIES DE COUVERTURE </a><br>
                    <button id="showGuide2" class="btn btn-submit" >Mode d'emploi </button>     
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header><br>
 
            <div id="guideJeux1" style="display:none;">
              <div class="container">
                <div class="row">
                  <div class="cta-info text-center">
                  <hr>
                  <h3 style="background-color: gray"> Guide d'utilisation C-real game</h3>
                  <hr> 
                  <h3> Jouer maintenant à la simulation</h3>
                  <section id="feature" class="section-padding">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-3 wow fadeInLeft delay-05s">
                          <div class="section-title">
                            <h2 class="head-title">Instructions</h2>
                            <hr class="botm-line">
                            <p class="sec-para">Pour aider les agriculteurs céréaliers à mieux comprendre et à utiliser la couverture financière, nous proposons une initiation aux marchés financiers à travers du jeu de simulation "C-REAL game". La version développée est destinée aux producteurs de blé tendre français. Le jeu se déroule sur une campagne agricole de plusieurs périodes, durant lesquelles l'agriculteur fait face à des variations de prix et doit vendre et acheter des contrats à terme (contrats MATIF) pour atteindre son prix de vente objectif.</div>
                        </div>
                        <div class="col-md-9">
                          <div class="col-md-6 wow fadeInRight delay-02s">
                            <div class="icon">
                              <i class="fa fa-flag"></i>
                            </div>
                            <div class="icon-text">
                              <h3 class="txt-tl">Départ</h3>
                              <p class="txt-para">Vous saisissez votre prix de vente objectif pour une tonne de blé. Vous observez ensuite les prix sur le marché à terme Euronext (MATIF) et sur le marché physique (prix ferme). Ces prix sont simulés et ne sont en aucun cas liés aux prix réels sur les marchés.</p>
                            </div>
                          </div>
                          <div class="col-md-6 wow fadeInRight delay-02s">
                            <div class="icon">
                              <i class="fa fa-step-forward"></i>
                            </div>
                            <div class="icon-text">
                              <h3 class="txt-tl">Période suivante</h3>
                              <p class="txt-para">A la période suivante, vous recevez un message présentant des informations sur l’actualité susceptibles d’influencer le marché : météorologie, événements internationaux, état de l’offre et la demande. Mais quel peut-être l’impact de ces informations ? Faut-il acheter ou vendre des contrats MATIF ?</p>
                            </div>
                          </div>
                          <div class="col-md-6 wow fadeInRight delay-04s">
                            <div class="icon">
                              <i class="fa fa-file"></i>
                            </div>
                            <div class="icon-text">
                              <h3 class="txt-tl">Contrat MATIF</h3>
                              <p class="txt-para">Vous avez une quantité de blé tendre à vendre, et son équivalent en contrats à terme. Dans le jeu comme sur Euronext, un contrat à terme est équivalent à 50 tonnes. Ainsi, à chaque période, vous aurez une quantité de blé à vendre et des contrats à terme. En fonction des prix, vous pouvez choisir de vendre la quantité que vous souhaitez sur le marché physique ou la totalité des tonnes qui vous ont été attribuées, ou même de ne pas vendre.  Vous devez également prendre une décision sur le marché à terme : voulez-vous couvrir toute la quantité vendue en vendant tous les contrats à terme, ou pensez-vous que les prix augmenteront ? Dans ce cas vous pouvez choisir de ne rien faire sur le marché à terme, ou même acheter des contrats.  
                                A chaque période, un bilan de votre situation financière est affiché. </p>
                            </div>
                          </div>
                          <div class="col-md-6 wow fadeInRight delay-04s">
                            <div class="icon">
                              <i class="fa fa-bullseye"></i>
                            </div>
                            <div class="icon-text">
                              <h3 class="txt-tl">Objectif</h3>
                              <p class="txt-para">Vous avez gagné si vous avez réussi à vendre à votre prix objectif, c’est-à-dire si le prix ferme que vous avez reçu en vendant votre récolte ainsi que les gains perçus sur le marché à terme dépassent votre prix de vente objectif. Les autres périodes se déroulent de la même manière.  </p>
                            </div>
                          </div>
                          <div class="col-md-6 wow fadeInRight delay-06s">
                            <div class="icon">
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="icon-text">
                              <h3 class="txt-tl">Fin du jeu</h3>
                              <p class="txt-para">Un bilan de la campagne sera dressé : vous pourrez voir l'évolution des prix par rapport à votre prix de vente objectif (donc si vous vous en êtes rapproché ou éloigné), mais aussi l’ensemble de vos gains ou pertes et votre comportement face au risque. Si vous le souhaitez, vous pourrez recommencer le jeu en restant sur la même campagne avec les mêmes informations sur l’actualité pour que vous puissiez changer votre prix objectif ou votre stratégie sur le marché à terme. Il est également possible de créer une nouvelle partie, totalement différente de la précédente.
                                De plus, votre classement par rapport aux autres joueurs est affiché.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </section><br>
                    <hr>
                    <button id="close1" type="button" class="btn btn-danger">Close</button>
                    <hr>
                  </div>
                    </div>
                  
                </div>
              </div>
            </div>

            <div id="guideJeux2" style="display:none;">
              <div class="container">
                <div class="row">
                  <div class="cta-info text-center">
                    <hr>
                    <h3 style="background-color: gray"> Guide d'utilisation C-real game</h3>
                    <hr> 
                  <h3> Comparer Différentes Stratégies De Couverture</h3><br>
                  <section id="feature" class="section-padding">
                    <div class="row">
                        <div class="col-md-3 ">
                          <p> Dans cette partie du site web, nous nous replaçons dans le passé, avec les données historiques réelles du marché Euronext. </p>
                        </div>
                        <div class="col-md-3 ">  
                          <p>   Afin d'évaluer votre stratégie de couverture contre la baisse des prix, nous vous demanderons de saisir une première date : c'est la date à laquelle vous auriez pris la décision d'utiliser un instrument financier.</p>
                        </div>
                        <div class="col-md-3 ">
                          <p>  Ensuite, vous devrez choisir un prix objectif de vente, et pour finir, une échéance : la date à laquelle vous souhaitez livrer votre marchandise. </p>
                        </div>
                          <div class="col-md-3 ">
                          <p>  Après validation, le site web calcule les prix obtenus avec la vente d'un contrat à terme, et l'achat d'une option put, pour indiquer le meilleur instrument d'après vos choix.</p>
                        </div>
                    </div>
                  </section>
                    <br>
                    <hr>
                    
                    <button id="close2" type="button" class="btn btn-danger">Close</button>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
  <section id="cta-1">
    <div class="container">
      <div class="row">
        <div class="cta-info text-center">
          <img src="img/cerealeLogo.png" alt="" width="25%" heigth="25%">
          <h3>C-REAL game a été développé dans le cadre d’un projet de recherche réalisé par Narjiss Araba (doctorante) en collaboration avec Philippe Cohard (maître de conférences),
            Alain François-Heude (professeur) de l’université de Montpellier et Louis-Antoine Saïsset (maître de conférences) de Montpellier SupAgro.
          </br></br>Le projet de thèse est réalisé au sein du laboratoire MRM (Montpellier Recherche en Management), cofinancé par l’université de Montpellier et #DigitAg, l’institut de
          convergences pour l’agriculture numérique.
          </br></br>Le développement informatique a été réalisé en collaboration avec l’école Polytech de Montpellier, par les étudiants Solène Serafin et Aubin Abadie, repris par Vincent Armant et Amine Ouail </h3>
          </br>
        <h2>Tutoriel</h2>
          <video  width="90%" height="auto" autoplay controls controlslist="nofullscreen nodownload noremoteplayback foobar noprogressbar" src="VideoTutoriel.mp4" ></video><br>
    </div></div></div>
  </section>
 
  <section class="section-padding parallax bg-image-2 section wow fadeIn delay-08s" id="cta-2">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="cta-txt">
            <h3>Venez essayer</h3>
            <p>Comme d'autres producteurs céréaliers, rejoignez-nous !</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          @guest
            <a href="#header" class="btn btn-submit">Jouer maintenant</a>
          @else
            @auth('admin')
              <a href="{{ route('editableParameter.index') }}" class="btn btn-submit">Jouer maintenant</a>
            @else
              <a href="{{ route('user.show', auth()->id()) }}" class="btn btn-submit">Jouer maintenant</a>
            @endauth
          @endguest
        </div>
      </div>
    </div>
  </section>
  <!---->
  <!---->
  <section class="section-padding wow fadeInUp delay-02s" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="section-title">
            <h2 class="head-title">Partenariats</h2>
            <hr class="botm-line">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="section-title">
          <h3><b>Conception et recherche :</b> Narjiss Araba  et Alain François-Heude</h3>
        </div>
        <div class="col-md-4 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
           <a href="https://mrm.edu.umontpellier.fr/" target="_blank"> <img src="img/mrm.jpg" alt="" class="img-responsive"></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="section-title">
          <h3><b>Soutien financier :</b></h3>
        </div>
        <div class="col-md-3 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
          <a href="https://www.hdigitag.fr/fr/" target="_blank"><img src="img/digitag.png"  alt="" class="img-responsive"></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
          <a href="https://www.umontpellier.fr" target="_blank"><img src="img/um.png" alt=""  class="img-responsive"></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
          <a href="https://muse.edu.umontpellier.fr/" target="_blank"><img src="img/muse.png" alt="" class="img-responsive">
          </div>
        </div>
        <div class="col-md-3 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
          <a href="https://anr.fr/" target="_blank"><img src="img/anr.png" alt="" class="img-responsive"></a>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="section-title">
            <h3><b>Réalisation :</b> Aubin Abadie et Solène Serafin </h3>
            <h3><b>Repris par :</b>  Vincent Armant et Amine Ouail </h3>
          </div>
        <div class="col-md-4 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
          <a href="https://www.polytech.umontpellier.fr/" target="_blank"> <img src="img/polytech.png" alt="" class="img-responsive"></a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 padding-right-zero">
          <div class="portfolio-box design">
          <a href="https://www.polytech.umontpellier.fr/formation/cycle-ingenieur/informatique-et-gestion/en-quelques-mots"target="_blank"> <img src="img/ig.jpg" alt="" class="img-responsive"></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!---->
  <!---->
  <section class="section-padding wow fadeInUp delay-05s" id="contact">
    <div class="container">
      <div class="row white">
        <div class="col-md-8 col-sm-12">
          <div class="section-title">
            <h2 class="head-title black">Contactez-nous</h2>
            <hr class="botm-line">
            <p class="sec-para black">Nous répondrons dès que possible à toutes vos demandes.</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <div class="col-md-4 col-sm-6" style="padding-left:0px;">
            <h3 class="cont-title">Envoyez-nous un email</h3>
            <div id="sendmessage">Votre message a bien été envoyé. Merci !</div>
            <div id="errormessage"></div>
            <div class="contact-info">
              <form action="{{route('contactForm') }}" method="post" role="form" class="contactForm">
               {{csrf_field()}}
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Votre nom" data-rule="minlen:4" data-msg="Entrer au moins 4 caractères" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" data-rule="email" data-msg="Entrer un email valide" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" data-rule="minlen:4" data-msg="Entrer au moins 8 caractères pour le sujet"  />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Ecrivez-nous un message" placeholder="Message"  ></textarea>
                  <div class="validation"></div>
                </div>
                <button type="submit" class="btn btn-send">Envoyer</button>
              </form>
            </div>

          </div>
          <div class="col-md-4 col-sm-6">
            <h3 class="cont-title">Rendez-nous visite</h3>
            <div class="location-info">
              <p class="white"><span aria-hidden="true" class="fa fa-map-marker"></span>163 rue Auguste Broussonnet, 34090 Montpellier, France</p>
              <p class="white"><span aria-hidden="true" class="fa fa-envelope"></span>Email: <a href="" class="link-dec">narjiss.araba@umontpellier.fr</a></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-icon-container hidden-md hidden-sm hidden-xs">
              <span aria-hidden="true" class="fa fa-envelope-o"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!---->
  <!---->
  <footer class="" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 footer-copyright">
          © Bethany Theme - All rights reserved
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bethany
            -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a><br>
            <a href="/mentions" target="_blank">Mentions Légales | Crédits | Confidentialité </a>
          </div>
        </div>
        <div class="col-sm-5 footer-social">
          <div class="pull-right hidden-xs hidden-sm">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!---->
  <!--contact ends-->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.js"></script>
  <script src="js/custom.js"></script>
 
  <script>
    document.getElementById('showGames').addEventListener('click', function() {
    document.getElementById('games').style.display='block';});

    document.getElementById('showGuide1').addEventListener('click', function() {
    document.getElementById('guideJeux1').style.display='block';
    document.getElementById('guideJeux2').style.display='none';});

    document.getElementById('showGuide2').addEventListener('click', function() {
    document.getElementById('guideJeux2').style.display='block';
    document.getElementById('guideJeux1').style.display='none';});

    document.getElementById('close1').addEventListener('click', function() {
    document.getElementById('guideJeux1').style.display='none';});

    document.getElementById('close2').addEventListener('click', function() {
    document.getElementById('guideJeux2').style.display='none';});
  </script>
  <script>
  function play(idPlayer, control) {
    var player = document.querySelector('#' + idPlayer);
	
    if (player.paused) {
        player.play();
        control.textContent = 'Pause';
    } else {
        player.pause();	
        control.textContent = 'Play';
    }
}

function resume(idPlayer) {
    var player = document.querySelector('#' + idPlayer);
	
    player.currentTime = 0;
    player.pause();
}
function volume(idPlayer, vol) {
    var player = document.querySelector('#' + idPlayer);
	
    player.volume = vol;	
}

function update(player) {
    var duration = player.duration;    // Durée totale
    var time     = player.currentTime; // Temps écoulé
    var fraction = time / duration;
    var percent  = Math.ceil(fraction * 100);

    var progress = document.querySelector('#progressBar');
	
    progress.style.width = percent + '%';
    progress.textContent = percent + '%';
    document.querySelector('#progressTime').textContent = formatTime(time);
}

function formatTime(time) {
    var hours = Math.floor(time / 3600);
    var mins  = Math.floor((time % 3600) / 60);
    var secs  = Math.floor(time % 60);
	
    if (secs < 10) {
        secs = "0" + secs;
    }
	
    if (hours) {
        if (mins < 10) {
            mins = "0" + mins;
        }
		
        return hours + ":" + mins + ":" + secs; // hh:mm:ss
    } else {
        return mins + ":" + secs; // mm:ss
    }
}
function getMousePosition(event) {
    return {
        x: event.pageX,
        y: event.pageY
    };
}
function getPosition(element){
    var top = 0, left = 0;
    
    do {
        top  += element.offsetTop;
        left += element.offsetLeft;
    } while (element = element.offsetParent);
    
    return { x: left, y: top };
}
function clickProgress(idPlayer, control, event) {
    var parent = getPosition(control);    // La position absolue de la progressBar
    var target = getMousePosition(event); // L'endroit de la progressBar où on a cliqué
    var player = document.querySelector('#' + idPlayer);
  
    var x = target.x - parent.x; 
    var wrapperWidth = document.querySelector('#progressBarControl').offsetWidth;
    
    var percent = Math.ceil((x / wrapperWidth) * 100);    
    var duration = player.duration;
    
    player.currentTime = (duration * percent) / 100;
}



</script>
@endsection
