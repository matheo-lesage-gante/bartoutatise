<!DOCTYPE html5>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/casino.css">
    </head>

    <body>
        <div id="conteneur0">

            <?php 
                $a;$b;$c;
                $a=random_int(1,6);
                $b=random_int(1,6);
                $c=random_int(1,6);
            ?>

            <img src="../../img/machine.jpg" class="image">
            <div class="conteneur" id="conteneur1">
                <?php
                switch ($a){
                    case 1:
                        ?>
                        <div class="diapo1" id="diapo1">
                            <?php
                        break;
                    case 2:
                        ?>
                        <div class="diapo1" id="diapo2">
                            <?php
                        break;
                    case 3:
                        ?>
                        <div class="diapo1" id="diapo3">
                            <?php
                        break;
                    case 4:
                        ?>
                        <div class="diapo1" id="diapo4">
                            <?php
                        break;
                    case 5:
                        ?>
                        <div class="diapo1" id="diapo5">
                            <?php
                        break;
                    case 6:
                        ?>
                        <div class="diapo1" id="diapo6">
                            <?php
                        break;
                }
                ?>
                    <img src="../../img/1.png"><img src="../../img/2.png"><img src="../../img/3.png"><img src="../../img/4.png"><img src="../../img/5.png"><img src="../../img/6.png"><img src="../../img/1.png"><img src="../../img/2.png"><img src="../../img/3.png"><img src="../../img/4.png"><img src="../../img/5.png"><img src="../../img/6.png">
                </div>
            </div>

            <div class="conteneur" id="conteneur2">
            <?php
                switch ($b){
                    case 1:
                        ?>
                        <div class="diapo2" id="diapo1">
                            <?php
                        break;
                    case 2:
                        ?>
                        <div class="diapo2" id="diapo2">
                            <?php
                        break;
                    case 3:
                        ?>
                        <div class="diapo2" id="diapo3">
                            <?php
                        break;
                    case 4:
                        ?>
                        <div class="diapo2" id="diapo4">
                            <?php
                        break;
                    case 5:
                        ?>
                        <div class="diapo2" id="diapo5">
                            <?php
                        break;
                    case 6:
                        ?>
                        <div class="diapo2" id="diapo6">
                            <?php
                        break;
                }
                ?>
                    <img src="../../img/1.png"><img src="../../img/2.png"><img src="../../img/3.png"><img src="../../img/4.png"><img src="../../img/5.png"><img src="../../img/6.png"><img src="../../img/1.png"><img src="../../img/2.png"><img src="../../img/3.png"><img src="../../img/4.png"><img src="../../img/5.png"><img src="../../img/6.png">
                </div>
            </div>

            <div class="conteneur" id="conteneur3">
                <?php
                switch ($c){
                    case 1:
                        ?>
                        <div class="diapo3" id="diapo1">
                            <?php
                        break;
                    case 2:
                        ?>
                        <div class="diapo3" id="diapo2">
                            <?php
                        break;
                    case 3:
                        ?>
                        <div class="diapo3" id="diapo3">
                            <?php
                        break;
                    case 4:
                        ?>
                        <div class="diapo3" id="diapo4">
                            <?php
                        break;
                    case 5:
                        ?>
                        <div class="diapo3" id="diapo5">
                            <?php
                        break;
                    case 6:
                        ?>
                        <div class="diapo3" id="diapo6">
                            <?php
                        break;
                }
                ?>
                    <img src="../../img/1.png"><img src="../../img/2.png"><img src="../../img/3.png"><img src="../../img/4.png"><img src="../../img/5.png"><img src="../../img/6.png"><img src="../../img/1.png"><img src="../../img/2.png"><img src="../../img/3.png"><img src="../../img/4.png"><img src="../../img/5.png"><img src="../../img/6.png">
                </div>
            </div>
            <a href="casino.php">lancer</a>

            
        </div>


    </body>
</html>
