<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/header.css">
</head>
<body>
<nav class="navbar">
    
    <div class ="nav-links">
      <ul>
        <li><a href="../php/index.php">Cervesia</a></li>
        <li><a href="../Amis/amis.php">Amix</a></li>
        <li><a href="../php/Map.php">Carte des Auberges</a></li>
        <li><a href="../php/taux_alcoolemie.php">Calculix alcoolix</a></li>
        <li><a href="../Avis/mes_avis.php">Avix</a></li>

        <?php 
        session_start();
        // Page admin
         if(isset($_SESSION['admin']) && $_SESSION['admin'] == 2) {  
            echo '<li><a href="../admin/admin.php">Admin</a></li>';
        }
        // Page profil
        if(isset($_SESSION['authentifie'])) { 
          echo '<li><a href="../php/profil.php">Profil</a></li>';
        }
        // Page d'accueil de l'auberge
        if((isset($_SESSION['admin']) && $_SESSION['admin'] == 1) || (isset($_SESSION['admin']) && $_SESSION['admin'] == 2)) { 
            echo '<li><a href="../php/Auberge.php">Taverne</a></li>';
        } 
         if(isset($_SESSION['authentifie'])) { 
            echo '<li><a href="../php/logout.php">Logout</a></li>';
        }
        else {
            echo '<li><a href="../php/login.php">Login</a></li>';
        } ?>
        
      </ul>
    </div>
    <img src="../../img/menu-btn.png" class="menu-hamburger" >
</nav>
  <header>
</header>
<script >
  const menuHamburger = document.querySelector(".menu-hamburger")
        const navLinks = document.querySelector(".nav-links")
 
        menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
        })
</script>
</body>
</html>