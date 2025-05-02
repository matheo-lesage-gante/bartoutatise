<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
    
    <div class ="nav-links">
      <ul>
        <li><a href="../php/accueil.php">Home</a></li>
        <li><a href="../php/contact.php">Contact</a></li>
        <li><a href="../php/Faq.php">About us</a></li>

        <?php 
        session_start();
         if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { 
            echo '<li><a href="../php/admin.php">Admin</a></li>';
        }
        if(isset($_SESSION['barman']) && $_SESSION['barman'] == 1) { 
            echo '<li><a href="../php/Auberge.php">MonAuberge</a></li>';
        } 
         if(isset($_SESSION['authentifie'])) { 
            echo '<li><a href="../php/logout.php">Logout</a></li>';
        }
        else {
            echo '<li><a href="../php/login.php">Login</a></li>';
        } ?>
        
      </ul>
    </div>
    <img src="../img/menu-btn.png" class="menu-hamburger" >
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