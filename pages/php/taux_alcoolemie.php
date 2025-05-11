<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Taux d'alcool</title>
    <link rel="stylesheet" href="../../css/taux_alcoolemie.css">
</head>
<body>
    <?php include 'header.php'; ?>
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
        <option value="option18">Shot alcool Léger</option>
        <option value="option19">Shot alcool Moyen</option>
        <option value="option20">Shot alcool Fort</option>
    </select>

    <div id="biereDegre">
        <label for="degreBiere">Entrez le degré d'alcool de la bière (%):</label>
        <input type="number" id="degreBiere" min="1" max="20" step="0.1" placeholder="5" />
    </div>
    
    <div id="List_verre">
        <div id="biere1">
            <label for="Verre_biere1">Bière 25cl</label>
            <span id="verre_biere1">0</span>
        </div>
        <div>
            <label for="Verre_biere2">Bière 33cl</label>
            <span id="verre_biere2">0</span>
        </div> 
        <div> 
            <label for="Verre_biere3">Bière 50cl</label>
            <span id="verre_biere3">0</span>
        </div>
        <div id="vr">
            <label for="VR">Verre de Vin Rouge</label>
            <span id="VR">0</span>
        </div>
        <div id="vb">
            <label for="VB">Verre de Vin Blanc</label>
            <span id="VB">0</span>
        </div>
        <div id="vro">
            <label for="VRO">Verre de Rosée</label>
            <span id="VRO">0</span>
        </div>
        <div id="cChampagne">
            <label for="Verre_Champagne">Champagne</label>
            <span id="Verre_Champagne">0</span>
        </div>
        <div id="Yager">
            <label for="Yager_Boob">Yager</label>
            <span id="Yager_Boob">0</span>
        </div>
        <div id="Sky">
            <label for="Sky_Coca">Sky</label>
            <span id="Sky_Coca">0</span>
        </div>
        <div id="Mojito">
            <label for="Verre_Mojito">Mojito</label>
            <span id="verre_Mojito">0</span>
        </div>
        <div id="Sexe_Beach">
            <label for="Verre_Sexe">Sexe on the Beach</label>
            <span id="verre_Sexe">0</span>
        </div>
        <div id="Margarita">
            <label for="verre_Margarita">Margarita</label>
            <span id="verre_Margarita">0</span>
        </div>
        <div id="Monaco">
            <label for="Verre_Mocano">Monaco</label>
            <span id="verre_Monaco">0</span>
        </div>
        <div id="Pina_Colada">
            <label for="Verre_Pina">Pina Colada</label>
            <span id="verre_Pina">0</span>
        </div>
        <div id="Blood_Marry">
            <label for="Verre_Blood">Blood Marry</label>
            <span id="verre_Blood">0</span>
        </div>
        <div id="Martini">
            <label for="Verre_Martini">Martini</label>
            <span id="verre_Martini">0</span>
        </div>
        <div id="Ricard">
            <label for="Verre_Ricard">Ricard</label>
            <span id="verre_Ricard">0</span>
        </div>
        <div id="Shot1">
            <label for="Shot_L">Shot léger</label>
            <span id="Shot_L">0</span>
        </div>
        <div id="Shot2">
            <label for="Shot_M">Shot moyen</label>
            <span id="Shot_M">0</span>
        </div>
        <div id="Shot3">
            <label for="Shot_F">Shot fort</label>
            <span id="Shot_F">0</span>
        </div>
        <button id="reset_verre" onclick="resetVerre()">Reset</button>
    </div>

    <br><br>
    <button onclick="calculerTaux()">Calculer le taux</button>
    <button onclick="resetTaux(); resetVerre()">Reset</button>

<script>
    let intervalId = null;
    let taux = 0;
    let verre_biere1 = 0;
    let verre_biere2 = 0;
    let verre_biere3 = 0;
    let VR = 0;
    let VB = 0;
    let VRO = 0;
    let Verre_Champagne = 0;
    let Yager_Boob = 0;
    let Sky_Coca = 0;
    let Verre_Mojito = 0;
    let Verre_Sky = 0;
    let Verre_Sexe = 0;
    let Verre_Margarita = 0;
    let Verre_Monaco = 0;
    let Verre_Pina = 0;
    let Verre_Blood = 0;
    let Verre_Martini = 0;
    let Verre_Ricard = 0;
    let shot1 = 0;
    let shot2 = 0;
    let shot3 = 0;

    function verifierBiere() {
        const choix = document.getElementById("choix").value;
        const champDegre = document.getElementById("biereDegre");
        champDegre.style.display = (choix === "option1" || choix === "option2" || choix === "option3") ? "block" : "none";
    }

    function calculerTaux() {
    
        let poids = 90;
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
                verre_biere1 += 1;
                document.getElementById("verre_biere1").textContent = verre_biere1;
                break;

            case "option2": //Bière 33cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (250 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                verre_biere2 += 1;
                document.getElementById("verre_biere2").textContent = verre_biere2;
                break;

            case "option3": //Bière 50cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (250 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                verre_biere3 += 1;
                document.getElementById("verre_biere3").textContent = verre_biere3;
                break;
            
            case "option4" : //Vin rouge
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                VR += 1;
                document.getElementById("VR").textContent = VR;
                break;

            case "option5" : //Vin blanc
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                VB += 1;
                document.getElementById("VB").textContent = VB;
                break;

            case "option6" : //Vin rosée
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                VRO += 1;
                document.getElementById("VRO").textContent = VRO;
                break;


            case "option7" : //Champagne
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Champagne += 1;
                document.getElementById("Verre_Champagne").textContent = Verre_Champagne;
                break;

            case "option8" : //Yager
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Yager_Boob += 1;
                document.getElementById("Yager_Boob").textContent = Yager_Boob;
                break;

            case "option9" : //Sky
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Sky_Coca += 1;
                document.getElementById("Sky_Coca").textContent = Sky_Coca;
                break;

            case "option10" : //Mojito
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Mojito += 1;
                document.getElementById("verre_Mojito").textContent = Verre_Mojito;
                break;

            case "option11" : //Sexe on the Beach
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Sexe += 1;
                document.getElementById("verre_Sexe").textContent = Verre_Sexe;
                break;

            case "option12" : //Margarita
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Margarite += 1;
                document.getElementById("verre_Margarita").textContent = Verre_Margarite;
                break;

            case "option13" : //Monaco
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Monaco += 1;
                document.getElementById("verre_Monaco").textContent = Verre_Monaco;
                break;

            case "option14" : //Pina Colado
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Pina += 1;
                document.getElementById("verre_Pina").textContent = Verre_Pina;
                break;

            case "option15" : //Blood Mary
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Blood += 1;
                document.getElementById("verre_Blood").textContent = Verre_Blood;
                break;

            case "option16" : //Martini
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Martini += 1;
                document.getElementById("verre_Martini").textContent = Verre_Martini;
                break;

            case "option17" : //Ricard
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Ricard += 1;
                document.getElementById("verre_Ricard").textContent = Verre_Ricard;
                break;

            case "option18" : //shot leger
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Shot1 += 1;
                document.getElementById("Shot_L").textContent = Shot1;
                break;

            case "option19" : //shot moyen
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Shot2 += 1;
                document.getElementById("Shot_M").textContent = Shot2;
                break;

            case "option20" : //Shot fort
                alcoolPur = 12;
                taux += alcoolPur / (poids * coeff_sexe);
                Shot3 += 1;
                document.getElementById("Shot_F").textContent = Shot3;
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
    function resetVerre(){
        verre_biere1 = 0;
        verre_biere2 = 0;
        verre_biere3 = 0;
        VR = 0;
        VB = 0;
        VRO = 0;
        Verre_Champagne = 0;
        Yager_Boob = 0;
        Sky_Coca = 0;
        Verre_Mojito = 0;
        Verre_Sky = 0;
        Verre_Sexe = 0;
        Verre_Margarita = 0;
        Verre_Monaco = 0;
        Verre_Pina = 0;
        Verre_Blood = 0;
        Verre_Martini = 0;
        Verre_Ricard = 0;
        shot1 = 0;
        shot2 = 0;
        shot3 = 0;

        document.getElementById("verre_biere1").textContent = "0";
        document.getElementById("verre_biere2").textContent = "0";
        document.getElementById("verre_biere3").textContent = "0";
        document.getElementById("VR").textContent = "0";
        document.getElementById("VB").textContent = "0";
        document.getElementById("VRO").textContent = "0";
        document.getElementById("Verre_Champagne").textContent = "0";
        document.getElementById("Yager_Boob").textContent = "0";
        document.getElementById("Sky_Coca").textContent = "0";
        document.getElementById("verre_Mojito").textContent = "0";
        document.getElementById("verre_Sexe").textContent = "0";
        document.getElementById("verre_Margarita").textContent = "0";
        document.getElementById("verre_Monaco").textContent = "0";
        document.getElementById("verre_Pina").textContent = "0";
        document.getElementById("verre_Blood").textContent = "0";
        document.getElementById("verre_Martini").textContent = "0";
        document.getElementById("verre_Ricard").textContent = "0";
        document.getElementById("Shot_L").textContent = "0";
        document.getElementById("Shot_M").textContent = "0";
        document.getElementById("Shot_F").textContent = "0";
    }

    function resetTaux(){
        taux = 0;
        
        const messages = document.querySelectorAll(".message-taux");
        messages.forEach(message => message.remove());
        
        
        const mess_taux = document.createElement("div");
        mess_taux.textContent = "Votre taux vient d'être réinitialisé à 0 g/l";
        mess_taux.className = "message-taux";
        document.body.appendChild(mess_taux);
    }
</script>

</body>
</html>