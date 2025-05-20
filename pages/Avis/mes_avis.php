<?php
require("../Amis/connexion.php");
session_start();

if (!isset($_SESSION['Id'])) {
    header("Location: ../php/login.php");
    exit();
}

// Suppression d'un avis
if (isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])) {
    $idAvis = intval($_GET['supprimer']);
    $idUser = $_SESSION['Id'];

    $sqlDelete = "DELETE FROM avis WHERE Id_avis = :idAvis AND Id_profil = :idUser";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':idAvis', $idAvis);
    $stmtDelete->bindParam(':idUser', $idUser);
    $stmtDelete->execute();

    header("Location: mes_avis.php?onglet=mes");
    exit();
}

// Récupération des avis
$idUser = $_SESSION['Id'];

// Recherche et tri pour avis communauté
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? '';

$baseQuery = "SELECT avis.*, profil.Pseudo FROM avis 
              JOIN profil ON avis.Id_profil = profil.Id
              WHERE Nom_bar LIKE :search";

if ($sort === 'note') {
    $baseQuery .= " ORDER BY note DESC";
} elseif ($sort === 'date') {
    $baseQuery .= " ORDER BY Date_avis DESC";
}

$stmtComm = $conn->prepare($baseQuery);
$searchParam = '%' . $search . '%';
$stmtComm->bindParam(':search', $searchParam);
$stmtComm->execute();
$avisCommunaute = $stmtComm->fetchAll(PDO::FETCH_ASSOC);

// Tri des avis personnels
$sortMes = $_GET['sort-mes'] ?? '';
$orderBy = '';
if ($sortMes === 'note') {
    $orderBy = ' ORDER BY note DESC';
} elseif ($sortMes === 'date') {
    $orderBy = ' ORDER BY Date_avis DESC';
}

$stmtPerso = $conn->prepare("SELECT * FROM avis WHERE Id_profil = :id_user" . $orderBy);
$stmtPerso->bindParam(':id_user', $idUser);
$stmtPerso->execute();
$mesAvis = $stmtPerso->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La Gazette des Gaulois</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #4a703c;
            margin: 0;
            padding: 0;
            color: #f5f1dc;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #f5f1dc;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
            color: #4a703c;
        }
        h1 {
            font-family: 'Papyrus', cursive;
            font-size: 2.5rem;
            text-align: center;
            color: #b79f57;
            text-shadow: 1px 1px #3b552d;
        }
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .tab-button {
            background-color: #b79f57;
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            color: #4a703c;
        }
        .tab-button.active {
            background-color: #fff8dc;
            border: 2px solid #4a703c;
        }
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        .avis {
            background: #fff8dc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .avis h3 {
            margin: 0 0 8px 0;
            color: #6b4e0e;
        }
        .avis p {
            margin: 0;
            color: #4a4a2a;
        }
        .note {
            font-weight: bold;
            color: #b79f57;
        }
        .date-avis {
            font-style: italic;
            color: #7c6b2e;
            font-size: 0.9rem;
            margin-left: 10px;
        }
        .delete-button {
            background-color: #a63e2a;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            cursor: pointer;
        }
        .add-button {
            background: #b79f57;
            color: #4a703c;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            display: block;
            margin: 20px auto 0;
            cursor: pointer;
        }
        .search-sort {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 10px;
        }
        .search-sort input, .search-sort select {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }
        form.sort-mes {
            margin-bottom: 15px;
            text-align: right;
        }
        form.sort-mes label {
            margin-right: 8px;
            font-weight: bold;
            color: #4a703c;
        }
        form.sort-mes select {
            padding: 5px 8px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }
    </style>
</head>
<body>
<?php include '../php/header.php'; ?>
<div class="container">
    <h1>La Gazette des Gaulois</h1>

    <div class="tabs">
        <button class="tab-button" id="tab-commu">Les potins du village</button>
        <button class="tab-button" id="tab-mes">Mes exploits héroïques</button>
    </div>

    <div class="section" id="commu-section">
        <form method="get" class="search-sort">
            <input type="text" name="search" placeholder="Chercher un bistrot ou une taverne..." value="<?= htmlspecialchars($search) ?>">
            <select name="sort">
                <option value="">-- Trier comme Panoramix --</option>
                <option value="note" <?= $sort === 'note' ? 'selected' : '' ?>>Par potion magique (note)</option>
                <option value="date" <?= $sort === 'date' ? 'selected' : '' ?>>Par fresque du druide (date)</option>
            </select>
            <button class="add-button"  type="submit">Chercher</button>
        </form>

        <?php if ($avisCommunaute): ?>
            <?php foreach ($avisCommunaute as $a): ?>
                <div class="avis">
                <h3>
                    <?= htmlspecialchars($a['Nom_bar']) ?>
                    <span class="note">
                        <?php 
                        $note = (int)$a['note'];
                        for ($i = 0; $i < $note; $i++) {
                            echo '<img src="../../img/gourde.png" alt="gourde pleine" style="width:20px; height:auto; vertical-align:middle; margin-right:2px;">';
                        }
                        for ($i = $note; $i < 5; $i++) {
                            echo '<img src="../../img/gourde_black.png" alt="gourde vide" style="width:20px; height:auto; vertical-align:middle; margin-right:2px;">';
                        }
                        ?>
                    </span>
                    <span class="date-avis"><?= date('d/m/Y', strtotime($a['date_avis'])) ?></span>
                </h3>
                    <p><?= nl2br(htmlspecialchars($a['avis'])) ?></p>
                    <p><em>Signé par le gaulois <?= htmlspecialchars($a['Pseudo']) ?></em></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Le village est calme, aucun potin pour le moment.</p>
        <?php endif; ?>
    </div>

    <div class="section" id="mes-section">
        <form method="get" class="sort-mes">
            <input type="hidden" name="onglet" value="mes">
            <label for="sort-mes">Trier mes exploits :</label>
            <select name="sort-mes" id="sort-mes" onchange="this.form.submit()">
                <option value="">-- Choisir un tri --</option>
                <option value="note" <?= ($sortMes === 'note') ? 'selected' : '' ?>>Par note</option>
                <option value="date" <?= ($sortMes === 'date') ? 'selected' : '' ?>>Par date</option>
            </select>
        </form>

        <?php if ($mesAvis): ?>
            <?php foreach ($mesAvis as $a): ?>
                <div class="avis">
                <h3>
                    <?= htmlspecialchars($a['Nom_bar']) ?>
                    <span class="note">
                        <?php 
                        $note = (int)$a['note'];
                        for ($i = 0; $i < $note; $i++) {
                            echo '<img src="../../img/gourde.png" alt="gourde pleine" style="width:20px; height:auto; vertical-align:middle; margin-right:2px;">';
                        }
                        for ($i = $note; $i < 5; $i++) {
                            echo '<img src="../../img/gourde_black.png" alt="gourde vide" style="width:20px; height:auto; vertical-align:middle; margin-right:2px;">';
                        }
                        ?>
                    </span>
                    <span class="date-avis"><?= date('d/m/Y', strtotime($a['date_avis'])) ?></span>
                </h3>
                    <p><?= nl2br(htmlspecialchars($a['avis'])) ?></p>
                    <form method="GET" onsubmit="return confirm('Voulez-vous vraiment effacer cet exploit ?');">
                        <input type="hidden" name="supprimer" value="<?= $a['Id_avis'] ?>">
                        <button type="submit" class="delete-button">Effacer cet exploit</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tu n'as encore raconté aucun exploit au village.</p>
        <?php endif; ?>

        <button class="add-button" onclick="window.location.href='ajouter_avis.php'">+ Raconter un nouvel exploit</button>
    </div>
</div>

<script>
    const tabCommu = document.getElementById('tab-commu');
    const tabMes = document.getElementById('tab-mes');
    const sectionCommu = document.getElementById('commu-section');
    const sectionMes = document.getElementById('mes-section');

    function showTab(which) {
        tabCommu.classList.remove('active');
        tabMes.classList.remove('active');
        sectionCommu.classList.remove('active');
        sectionMes.classList.remove('active');

        if (which === 'commu') {
            tabCommu.classList.add('active');
            sectionCommu.classList.add('active');
        } else {
            tabMes.classList.add('active');
            sectionMes.classList.add('active');
        }
    }

    tabCommu.addEventListener('click', () => showTab('commu'));
    tabMes.addEventListener('click', () => showTab('mes'));

    const params = new URLSearchParams(window.location.search);
    const onglet = params.get('onglet');
    showTab(onglet === 'mes' ? 'mes' : 'commu');
</script>
</body>
</html>
