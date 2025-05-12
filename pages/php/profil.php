<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Gaulois</title>
  <link rel="stylesheet" href="../../css/profil.css" />
</head>
<body>
  <div class="parchemin">
    <header>
      <h1>⚔️ Profil de Gaulois : Astérix</h1>
    </header>

    <section class="profil">
      <img src="avatar.png" alt="avatar" class="portrait" />
      <div class="infos">
        <h2>Nom : Astérix</h2>
        <p><strong>Tribu :</strong> Les Irréductibles Gaulois</p>
        <p><strong>Force spéciale :</strong> Buveur de potion magique 💥</p>
        <p><strong>Compagnon :</strong> Obélix (et Idéfix 🐶)</p>
        <p><strong>Phrase culte :</strong> “Ils sont fous ces Romains !”</p>
      </div>
    </section>

    <div class="profil-trophees">
        <h2>Trophées</h2>
        <div class="trophees">
            <div class="trophee">
                <img src="trophee1.png" alt="Trophée 1">
                <p>Trophée 1</p>
            </div>
            <div class="trophee">
                <img src="trophee2.png" alt="Trophée 2">
                <p>Trophée 2</p>
            </div>
            <div class="trophee trophee-cache">
                <img src="trophee3.png" alt="Trophée 3">
                <p>Trophée 3</p>
            </div>
            <div class="trophee trophee-cache">
                <img src="trophee4.png" alt="Trophée 4">
                <p>Trophée 4</p>
            </div>
            <div class="trophee trophee-cache">
                <img src="trophee5.png" alt="Trophée 5">
                <p>Trophée 5</p>
            </div>
            <button id="voirPlusBtn">Voir plus...</button>
            <button id="voirMoinsBtn" style="display: none;">Voir moins...</button>
        </div>
    </div>


    <script>
  const voirPlusBtn = document.getElementById("voirPlusBtn");
  const voirMoinsBtn = document.getElementById("voirMoinsBtn");
  const tropheesCaches = document.querySelectorAll(".trophee-cache");

  voirPlusBtn.addEventListener("click", () => {
    tropheesCaches.forEach(el => el.style.display = "block");
    voirPlusBtn.style.display = "none";
    voirMoinsBtn.style.display = "block";
  });

  voirMoinsBtn.addEventListener("click", () => {
    tropheesCaches.forEach(el => el.style.display = "none");
    voirPlusBtn.style.display = "block";
    voirMoinsBtn.style.display = "none";
  });
</script>



    <footer>
      <p>© Village Gaulois - 50 avant J.C.</p>
    </footer>
  </div>
</body>
</html>
