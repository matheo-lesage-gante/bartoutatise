<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Taux d'alcool</title>
    <link rel="stylesheet" href="../../css/taux_alcoolemie.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1 id="titre">Taux d'alcool dans le sang</h1>
    
    <script>
        alert("Attention à plus de 0,25 mg/l d'air expiré il est interdit de prendre le volant \nLe taux qu'on va vous donner est approximative");
        window.onload = function () {
            poids();
            verifierBiere(); // Affiche correctement le champ au chargement
            loadFromCookie();
            affiche_data();
            updateBeerGlass(cookieData.taux);
        };
        // Sauvegarder dans un cookie
        function saveToCookie() {
            const data = {
                taux: taux,
                Verres: Verres,
                timestamp: new Date().getTime()
            };

            const expires = new Date();
            expires.setDate(expires.getDate() + 1);

            document.cookie = `alcoolData=${encodeURIComponent(JSON.stringify(data))}; expires=${expires.toUTCString()}; path=/`;
        }

        // Charger depuis un cookie
        function loadFromCookie() {
            const cookies = document.cookie.split(';');
            for (const cookie of cookies) {
                if (cookie.includes('alcoolData=')) {
                    const cookieData = JSON.parse(decodeURIComponent(cookie.split('alcoolData=')[1]));
                    // Vérifier si le cookie est toujours valide (24h)
                    const now = new Date().getTime();
                    if (now - cookieData.timestamp < 86400000) { // 24h en ms
                        taux = cookieData.taux;
                        Object.keys(cookieData.Verres).forEach(key => {
                            Verres[key] = cookieData.Verres[key];
                        });
                        updateAllCounters();
                        return true;
                    }
                }
            }
            return false;
        }

        // Mettre à jour tous les compteurs
        function updateAllCounters() {
            document.getElementById("Verre_biere1").textContent = Verre_biere1;
            document.getElementById("Verre_biere2").textContent = Verre_biere2;
            document.getElementById("Verre_biere3").textContent = Verre_biere3;
            document.getElementById("VR").textContent = VR;
            document.getElementById("VB").textContent = VB;
            document.getElementById("VRO").textContent = VRO;
            document.getElementById("Verre_Champagne").textContent = Verre_Champagne;
            document.getElementById("Yager_Boob").textContent = Yager_Boob;
            document.getElementById("Sky_Coca").textContent = Sky_Coca;
            document.getElementById("Verre_Mojito").textContent = Verre_Mojito;
            document.getElementById("Verre_Sexe").textContent = Verre_Sexe;
            document.getElementById("Verre_Margarita").textContent = Verre_Margarita;
            document.getElementById("Verre_Monaco").textContent = Verre_Monaco;
            document.getElementById("Verre_Pina").textContent = Verre_Pina;
            document.getElementById("Verre_Blood").textContent = Verre_Blood;
            document.getElementById("Verre_Martini").textContent = Verre_Martini;
            document.getElementById("Verre_Ricard").textContent = Verre_Ricard;
            document.getElementById("shot_L").textContent = shot1;
            document.getElementById("shot_M").textContent = shot2;
            document.getElementById("shot_F").textContent = shot3;
        }
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
    
    <div id="List_Verre">
        <div id="Biere1" class="div_verre">
            <div class="verre" id="biere1">
                <label for="Verre_biere1">Bière 25cl</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_biere1">0</span>
            </div>
        </div>
        <div id="Biere2" class="div_verre">
            <div class="verre" id="biere2">
                <label for="Verre_biere2">Bière 33cl</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_biere2">0</span>
            </div> 
        </div>
        <div id="Biere3" class="div_verre">
            <div class="verre" id="biere3"> 
                <label for="Verre_biere3">Bière 50cl</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_biere3">0</span>
            </div>
        </div>
        <div id="verre_rouge" class="div_verre">
            <div class="verre" id="vr">
                <label for="VR">Verre de Vin Rouge</label>
            </div>
            <div class="nb_verre">
                <span id="VR">0</span>
            </div>
        </div>
        <div id="verre_blanc" class="div_verre">
            <div class="verre" id="vb">
                <label for="VB">Verre de Vin Blanc</label>
            </div>
            <div class="nb_verre">
                <span id="VB">0</span>
            </div>
        </div>
        <div id="verre_rosee" class="div_verre">
            <div class="verre" id="vro">
                <label for="VRO">Verre de Rosée</label>
            </div>
            <div class="nb_verre">
                <span id="VRO">0</span>
            </div>
        </div>
        <div id="verre_champagne" class="div_verre">
            <div class="verre" id="Champagne">
                <label for="Verre_Champagne">Champagne</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Champagne">0</span>
            </div>
        </div>
        <div id="yager" class="div_verre">
            <div class="verre" id="Yager">
                <label for="Yager_Boob">Yager</label>
            </div>
            <div class="nb_verre">
                <span id="Yager_Boob">0</span>
            </div>
        </div>
        <div id="sky" class="div_verre">
            <div class="verre" id="Sky">
                <label for="Sky_Coca">Sky</label>
            </div>
            <div class="nb_verre">
                <span id="Sky_Coca">0</span>
            </div>
        </div>
        <div id="mojitio" class="div_verre">
            <div class="verre" id="Mojito">
                <label for="Verre_Mojito">Mojito</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Mojito">0</span>
            </div>
        </div>
        <div id="Sexe" class="div_verre">
            <div class="verre" id="Sexe_Beach">
                <label for="Verre_Sexe">Sexe on the Beach</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Sexe">0</span>
            </div>
        </div>
        <div id="margarita" class="div_verre">
            <div class="verre" id="Margarita">
                <label for="Verre_Margarita">Margarita</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Margarita">0</span>
            </div>
        </div>
        <div id="monaco" class="div_verre">
            <div class="verre" id="Monaco">
                <label for="Verre_Monaco">Monaco</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Monaco">0</span>
            </div>
        </div>
        <div id="Pina" class="div_verre">
            <div class="verre" id="Pina_Colada">
                <label for="Verre_Pina">Pina Colada</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Pina">0</span>
            </div>
        </div>
        <div id="Blood" class="div_verre">
            <div class="verre" id="Blood_Marry">
                <label for="Verre_Blood">Blood Marry</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Blood">0</span>
            </div>
        </div>
        <div id="martini" class="div_verre">
            <div class="verre" id="Martini">
                <label for="Verre_Martini">Martini</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Martini">0</span>
            </div>
        </div>
        <div id="ricard" class="div_verre">
            <div class="verre" id="Ricard">
                <label for="Verre_Ricard">Ricard</label>
            </div>
            <div class="nb_verre">
                <span id="Verre_Ricard">0</span>
            </div>    
        </div>
        <div id="shot1" class="div_verre">
            <div class="verre" id="Shot1">
                <label for="Shot_L">Shot léger</label>
            </div>
            <div class="nb_verre">
                <span id="Shot_L">0</span>
            </div>
        </div>
        <div id="shot2" class="div_verre">
            <div class="verre" id="Shot2">
                <label for="Shot_M">Shot moyen</label>
            </div>
            <div class="nb_verre">
                <span id="Shot_M">0</span>
            </div>
        </div>
        <div id="shot3" class="div_verre">
            <div class="verre" id="Shot3">
                <label for="Shot_F">Shot fort</label>
            </div>
            <div class="nb_verre">
                <span id="Shot_F">0</span>
            </div>
        </div>
    </div>

    <div class="beer-container">
        <div class="beer-glass">
            <div class="beer-foam"></div>
            <div class="beer-liquid" id="beer-liquid"></div>
        </div>
        <div class="beer-base"></div>
    </div>

    <br><br>
    <button onclick="calculerTaux()">Ajouter</button>
    <button onclick="resetTaux(); resetVerre()">Reset</button>
    <button id="supp_cookie" onclick="supp_cookie()">Reset Cookies</button>

<script>
    let intervalId = null;
    let taux = 0;
    let Verre_biere1 = 0;
    let Verre_biere2 = 0;
    let Verre_biere3 = 0;
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
    
    const Verres = {
        Verre_biere1, Verre_biere2, Verre_biere3, VR, VB, VRO,
        Verre_Champagne, Yager_Boob, Sky_Coca, Verre_Mojito, Verre_Sexe,
        Verre_Margarita, Verre_Monaco, Verre_Pina, Verre_Blood,
        Verre_Martini, Verre_Ricard, shot1, shot2, shot3
    };

    function verifierBiere() {
        const choix = document.getElementById("choix").value;
        const champDegre = document.getElementById("biereDegre");
        champDegre.style.display = (choix === "option1" || choix === "option2" || choix === "option3") ? "block" : "none";
    }

    function poids() {
        // Création des éléments
        const divPoids = document.createElement('div');
        divPoids.id = 'poidsContainer'; // Ajout d'un ID pour faciliter la sélection
        
        const labelPoids = document.createElement('label');
        const inputPoids = document.createElement('input');
        const validerBtn = document.createElement('button');

        // Configuration des éléments
        labelPoids.htmlFor = 'poidsInput';
        labelPoids.textContent = 'Votre poids (kg) :';

        inputPoids.type = 'number';
        inputPoids.id = 'poidsInput';
        inputPoids.min = '30';
        inputPoids.max = '200';
        inputPoids.step = '0.1';
        inputPoids.required = true;

        validerBtn.textContent = 'Valider';
        validerBtn.onclick = function() {

            const valeur = parseFloat(inputPoids.value);
            poids = valeur;

            if(poids > 0){
                divPoids.remove();
                alert(`Poids enregistré : ${poids} kg`);
            }
        
            else{
                alert("entrez un poids");
            }
        };

        divPoids.appendChild(labelPoids);
        divPoids.appendChild(inputPoids);
        divPoids.appendChild(validerBtn);

        divPoids.style.margin = '20px 0';
        inputPoids.style.marginLeft = '10px';
        validerBtn.style.marginLeft = '10px';
        validerBtn.style.top = '0px';

        const titre = document.getElementById('titre');
        titre.insertAdjacentElement('afterend', divPoids);
}


    function calculerTaux() {
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
                Verre_biere1 += 1;
                document.getElementById("Verre_biere1").textContent = Verre_biere1;
                saveToCookie();
                break;

            case "option2": //Bière 33cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (330 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_biere2 += 1;
                document.getElementById("Verre_biere2").textContent = Verre_biere2;
                saveToCookie();
                break;

            case "option3": //Bière 50cl
                degre = parseFloat(document.getElementById("degreBiere").value);
                if (isNaN(degre) || degre <= 0) {
                    alert("Veuillez entrer un degré d’alcool valide pour la bière.");
                    return;
                }
                alcoolPur =  (500 * degre) / 100;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_biere3 += 1;
                document.getElementById("Verre_biere3").textContent = Verre_biere3;
                saveToCookie();
                break;
            
            case "option4" : //Vin rouge
                alcoolPur = 11.52;
                taux += alcoolPur / (poids * coeff_sexe);
                VR += 1;
                document.getElementById("VR").textContent = VR;
                saveToCookie();
                break;

            case "option5" : //Vin blanc
                alcoolPur = 11;
                taux += alcoolPur / (poids * coeff_sexe);
                VB += 1;
                document.getElementById("VB").textContent = VB;
                saveToCookie();
                break;

            case "option6" : //Vin rosée
                alcoolPur = 10.5;
                taux += alcoolPur / (poids * coeff_sexe);
                VRO += 1;
                document.getElementById("VRO").textContent = VRO;
                saveToCookie();
                break;


            case "option7" : //Champagne
                alcoolPur = 9.6;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Champagne += 1;
                document.getElementById("Verre_Champagne").textContent = Verre_Champagne;
                saveToCookie();
                break;

            case "option8" : //Yager
                alcoolPur = 28;
                taux += alcoolPur / (poids * coeff_sexe);
                Yager_Boob += 1;
                document.getElementById("Yager_Boob").textContent = Yager_Boob;
                saveToCookie();
                break;

            case "option9" : //Sky
                alcoolPur = 18;
                taux += alcoolPur / (poids * coeff_sexe);
                Sky_Coca += 1;
                document.getElementById("Sky_Coca").textContent = Sky_Coca;
                saveToCookie();
                break;

            case "option10" : //Mojito
                alcoolPur = 16;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Mojito += 1;
                document.getElementById("Verre_Mojito").textContent = Verre_Mojito;
                saveToCookie();
                break;

            case "option11" : //Sexe on the Beach
                alcoolPur = 19.2;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Sexe += 1;
                document.getElementById("Verre_Sexe").textContent = Verre_Sexe;
                saveToCookie();
                break;

            case "option12" : //Margarita
                alcoolPur = 24;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Margarita += 1;
                document.getElementById("Verre_Margarita").textContent = Verre_Margarita;
                saveToCookie();
                break;

            case "option13" : //Monaco
                alcoolPur = 6;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Monaco += 1;
                document.getElementById("Verre_Monaco").textContent = Verre_Monaco;
                saveToCookie();
                break;

            case "option14" : //Pina Colado
                alcoolPur = 14.4;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Pina += 1;
                document.getElementById("Verre_Pina").textContent = Verre_Pina;
                saveToCookie();
                break;

            case "option15" : //Blood Mary
                alcoolPur = 14.4;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Blood += 1;
                document.getElementById("Verre_Blood").textContent = Verre_Blood;
                saveToCookie();
                break;

            case "option16" : //Martini
                alcoolPur = 8.4;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Martini += 1;
                document.getElementById("Verre_Martini").textContent = Verre_Martini;
                saveToCookie();
                break;

            case "option17" : //Ricard
                alcoolPur = 14.4;
                taux += alcoolPur / (poids * coeff_sexe);
                Verre_Ricard += 1;
                document.getElementById("Verre_Ricard").textContent = Verre_Ricard;
                saveToCookie();
                break;

            case "option18" : //shot leger
                alcoolPur = 2.4;
                taux += alcoolPur / (poids * coeff_sexe);
                Shot1 += 1;
                document.getElementById("Shot_L").textContent = Shot1;
                saveToCookie();
                break;

            case "option19" : //shot moyen
                alcoolPur = 6;
                taux += alcoolPur / (poids * coeff_sexe);
                Shot2 += 1;
                document.getElementById("Shot_M").textContent = Shot2;
                saveToCookie();
                break;

            case "option20" : //Shot fort
                alcoolPur = 9.6;
                taux += alcoolPur / (poids * coeff_sexe);
                Shot3 += 1;
                document.getElementById("Shot_F").textContent = Shot3;
                saveToCookie();
                break;
        };
        updateBeerGlass(taux)
        let mess_taux = document.createElement("div");
        mess_taux.textContent = "taux estimé : " + taux.toFixed(2) + " g/l";
        mess_taux.className = "message-taux";

        // Appliquer la classe safe ou danger
        if (taux < 0.25) {
            mess_taux.classList.add('safe');
        } 
        
        else {
            mess_taux.classList.add('danger');
        }

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
                    document.body.appendChild(mess_taux);
                }

            }
        }, 3600000); //toute les heures
        document.getElementById("taux").textContent = taux.toFixed(3);
    }

    function updateBeerGlass(taux) {

        const beerLiquid = document.getElementById('beer-liquid');
        if (!beerLiquid) return;

        const maxTaux = 2.0; 
        const maxHeight = 80; 

        let fillPercentage = (taux / maxTaux) * maxHeight; // Utilisez taux
        fillPercentage = Math.min(fillPercentage, maxHeight);

        beerLiquid.style.height = fillPercentage + '%';

        if (taux < 0.25) {
            beerLiquid.style.background = 'green';
        } else if (taux < 0.5) {
            beerLiquid.style.background = 'orange';
        } else {
            beerLiquid.style.background = 'red';
        }
    }


    function resetVerre(){
        Verre_biere1 = 0;
        Verre_biere2 = 0;
        Verre_biere3 = 0;
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

        document.getElementById("Verre_biere1").textContent = "0";
        document.getElementById("Verre_biere2").textContent = "0";
        document.getElementById("Verre_biere3").textContent = "0";
        document.getElementById("VR").textContent = "0";
        document.getElementById("VB").textContent = "0";
        document.getElementById("VRO").textContent = "0";
        document.getElementById("Verre_Champagne").textContent = "0";
        document.getElementById("Yager_Boob").textContent = "0";
        document.getElementById("Sky_Coca").textContent = "0";
        document.getElementById("Verre_Mojito").textContent = "0";
        document.getElementById("Verre_Sexe").textContent = "0";
        document.getElementById("Verre_Margarita").textContent = "0";
        document.getElementById("Verre_Monaco").textContent = "0";
        document.getElementById("Verre_Pina").textContent = "0";
        document.getElementById("Verre_Blood").textContent = "0";
        document.getElementById("Verre_Martini").textContent = "0";
        document.getElementById("Verre_Ricard").textContent = "0";
        document.getElementById("Shot_L").textContent = "0";
        document.getElementById("Shot_M").textContent = "0";
        document.getElementById("Shot_F").textContent = "0";
        saveToCookie();
    }

    function resetTaux(){
        taux = 0;
        updateBeerGlass(0);
        
        const messages = document.querySelectorAll(".message-taux");
        messages.forEach(message => message.remove());
        
        let mess_taux = document.createElement("div");
        mess_taux.textContent = "Votre taux vient d'être réinitialisé à 0 g/l";
        mess_taux.className = "message-taux";
        document.body.appendChild(mess_taux);
        saveToCookie();
    }

    function supp_cookie(){
        const expires = new Date(0).toUTCString();
        document.cookie = `alcoolData=; expires=${expires}; path=/`;
        const mess_taux = document.createElement("div");
        mess_taux.className = "message-taux";
        mess_taux.textContent = "Vous venez de reinitialisé votre cookie";
        document.body.appendChild(mess_taux);
    
    }

    const cookieRow = document.cookie.split('; ').find(row => row.startsWith('alcoolData='));
    const cookieValue = decodeURIComponent(cookieRow.split('=')[1]);
    const alcoolData = JSON.parse(cookieValue);
    taux_c = alcoolData.taux;
    const mess_taux = document.createElement("div");
    mess_taux.className = "message-taux";
    mess_taux.textContent = "Taux estimé : " + taux_c.toFixed(2) + " g/l";
    document.body.appendChild(mess_taux);
    
</script>

</body>
</html>