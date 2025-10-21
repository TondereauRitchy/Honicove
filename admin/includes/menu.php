

<div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li class="active">
          <a href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        </li>
        <li><a href="produit.php"><i class="fas fa-tshirt"></i><span>Produit</span></a></li>
        <!--<li><a href="contact.php"><i class="fas fa-phone"></i><span>Contact</span></a></li>-->
        <li><a href="settings.php"><i class="fas fa-cog"></i><span>Settings</span></a></li>
        <li class="logout">
          <a id="logoutBtn" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Log out</span></a>
        </li>
      </ul>
    </div>
<script>
    // Déconnexion
     function logout() {
        fetch('controller/logout.php')
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Erreur lors de la déconnexion.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la déconnexion.');
            });
        }
    
</script>