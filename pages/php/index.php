<!DOCTYPE html5>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../css/index.css">
  </head>
  <body>
    <?php include 'header.php'?>
    <section>
          <h1 id="titre">BAR'TOUTATISE</h1>
          <div class="wave" id="wave1" style="--i:1;"></div>
          <div class="wave" id="wave2" style="--i:2;"></div>
          <div class="wave" id="wave3" style="--i:3;"></div>
          <div class="wave" id="wave4" style="--i:4;"></div>
      </section>
      <div class='scroll'>
          <h2>Bienvenue, valeureux Gaulois !</h2>
          <p>
              Par Toutatis !<br>
              Le village de Lille regorge de tavernes et de repaires où festoyer comme un véritable Gaulois.<br>
              Avec BAR'TOUTATISE, partez à la découverte des meilleurs bars de la région, qu'ils soient connus ou bien cachés.
          </p>
          <div class="defile">
              <div class="bar bar1"></div>
              <div class="bar bar2"></div>
              <div class="bar bar3"></div>
              <div class="bar bar4"></div>
              <div class="bar bar5"></div>
              <div class="bar bar6"></div>
              <div class="bar bar7"></div>
              <div class="bar bar8"></div>
          </div>
          <h3>Fonctions Principales</h3>
          <div class="content-container">
              <div class="text-section">
                  <h4>
                      <b>- Explorer les Bars de Lille :</b> Consultez les bars notés par la communauté et découvrez de nouvelles adresses.<br><br>
                      <b>- Générateur de Barathon :</b> Créez votre parcours de bars en fonction de vos alcools préférés.<br><br>
                      <b>- Calculateur de Taux d'Alcoolémie :</b> Restez responsable en suivant votre consommation.<br><br>
                      <b>- Mini-Jeu "Qui Paie sa Tournée ?" :</b> Amusez-vous avec vos amis pour désigner celui qui paie.<br><br>
                      <b>- Carte Interactive :</b> Ajoutez des pins pour chaque verre dégusté dans un bar.
                  </h4>
              </div>
              <div class="image-section">
                  <img src="../../img/asterix.png" alt="Astérix avec une bière"/>
              </div>
          </div>
      </div>
      
      <script>
          let wave1 = document.getElementById('wave1');
          let wave2 = document.getElementById('wave2');
          let wave3 = document.getElementById('wave3');
          let wave4 = document.getElementById('wave4');

          window.addEventListener('scroll', function(){
              let value = window.scrollY;
              wave1.style.backgroundPosition = 400 + value * 4 + 'px';
              wave2.style.backgroundPosition = 300 + value * -4 + 'px';
              wave3.style.backgroundPosition = 200 + value * 2 + 'px';
              wave4.style.backgroundPosition = 100 + value * -2 + 'px';
          });
      </script>
  </body>
</html>