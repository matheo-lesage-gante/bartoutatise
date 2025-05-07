<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Taux d'alcool</title>
    <link rel="stylesheet" href="taux_alcoolemie.css">
</head>
<body>

    <h1 id="titre">Taux d'alcool dans le sang</h1>
    
    <script>
        alert("Attention à plus de 0,25 mg/l d'air expiré il est interdit de prendre le volant \nLe taux qu'on va vous donner est approximative");

        window.onload = function () {
        verifierBiere(); // Affiche correctement le champ au chargement
        };
    </script>

    <label for="choix">Quel alcool avez-vous bu :</label>
    <select id="choix" onchange="verifierBiere()">
        <option value="option1">Bière 25cl</option>
        <option value="option2">Bière 33cl</option>
        <option value="option3">Bière 50cl</option>
        <option value="option4">Verre de Vin Rouge</option>
        <option value="option5">Verre de Vin blanc</option>
        <option value="option6">Verre de Rosé</option>
        <option value="option7">Verre de Champagne</option>
        <option value="option8">Yager boob</option>
        <option value="option9">sky coca</option>
        <option value="option10">Mojito</option>
        <option value="option11">Sexe on the Beach</option>
        <option value="option12">Margarita</option>
        <option value="option13">Monaco</option>
        <option value="option14">Pina Colada</option>
        <option value="option15">Bloody Marry</option>
        <option value="option16">Martini</option>
        <option value="option17">Ricard</option>
        <option value="option18">Shot alcool Fort</option>
        <option value="option19">Shot alcool Moyen</option>
        <option value="option20">Shot alcool Léger</option>
    </select>

    <div id="biereDegre">
        <label for="degreBiere">Entrez le degré d'alcool de la bière (%):</label>
        <input type="number" id="degreBiere" min="1" max="20" step="0.1" placeholder="ex: 5" />
    </div>

    <br><br>
    <button onclick="calculerTaux()">Calculer le taux</button>

<script>
    let intervalId = null;
    let taux = 0;
    function verifierBiere() {
        const choix = document.getElementById("choix").value;
        const champDegre = document.getElementById("biereDegre");
        champDegre.style.display = (choix === "option1" || choix === "option2" || choix === "option3") ? "block" : "none";
    }

    function calculerTaux() {
    
        let poids = 80;
        let sexe = "M";
        let coeff_sexe = (sexe === "M") ? 0.68 : 0.55;
        let degre;
        let alcoolPur;

        const choix = document.getElementById("choix").value;

        switch (choix) {
        
            case "option1": //Bière 25cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (250 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option2": //Bière 33cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (250 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option3": //Bière 50cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (250 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                break;
            
            case "option4" : //Vin rouge
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option5" : //Vin blanc
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option6" : //Vin rosée
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;


            case "option7" : //Champagne
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option8" : //Yager
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option9" : //Sky
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option10" : //Mojito
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option11" : //Sexe on the Beach
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option12" : //Margarita
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option13" : //Monaco
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option14" : //Pina Colado
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option15" : //Blood Mary
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option16" : //Martini
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option17" : //Ricard
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option18" : //shot leger
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option19" : //shot moyen
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;

            case "option20" : //Shot fort
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                break;
        }
;
        let mess_taux = document.createElement("div");
        mess_taux.textContent = "taux estimé : " + taux.toFixed(2) + " g/l";
        mess_taux.className = "message-taux"
        document.body.appendChild(mess_taux);

        intervalId = setInterval(() => {
            if (taux > 0) {
                taux = Math.max(0, taux - 0.15);
                if(taux == 0){
                    clearInterval(intervalId);
                    alert("Vous n'avez plus d'alcool détectable dans le sang.");
                }
                else {
                    mess_taux = document.createElement("div");
                    mess_taux.textContent = "taux estimé : " + taux.toFixed(2) + " g/l";
                    document.body.appendChild(mess_taux);;
                }
            }
        }, 3600000); //toute les heures
    }
</script>

</body>
</html>