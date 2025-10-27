<?php
session_start();
$adminLoggedIn = !empty($_SESSION['admin_logged_in']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Page Admin</title>
  <script>
    const adminLoggedIn = <?= $adminLoggedIn ? 'true' : 'false' ?>;
  </script>
</head>
<body>

  <!-- MODAL DE CONNEXION -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <h2 id="formTitle">Connexion Administrateur</h2>
      <form id="loginForm">
        <label for="email">Email</label>
        <input type="email" id="email" autocomplete="username" required>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" autocomplete="current-password" required>
        <button type="submit" id="loginBtn">
          <span id="btnText">Se connecter</span>
          <div class="loader" id="loader" style="display:none;"></div>
        </button>
        <p class="forgot">
          <a href="#" id="forgotLink">Mot de passe oublié ?</a>
        </p>
      </form>

      <form id="resetForm" style="display:none;">
        <label for="resetEmail">Votre email</label>
        <input type="email" id="resetEmail" required>
        <button type="submit">Envoyer lien de réinit.</button>
        <p class="forgot">
          <a href="#" id="backToLogin">← Retour</a>
        </p>
      </form>
    </div>
  </div>

  <!-- APPLICATION ADMIN -->
  <div id="app" style="display:none;">
    <?php require('includes/menu.php'); ?>

    <main class="main-content">
      <h1>Bienvenue sur le Dashboard</h1>
      <div class="cards">
        <div class="card">
          <h3>Produits</h3>
          <p id="nbProduits"></p>
        </div>
        <div class="card">
          <h3>Contacts</h3>
          <p id="nbContacts"></p>
        </div>
        <div class="card">
          <h3>Revenus</h3>
          <p>2 500 €</p>
        </div>
      </div>

      <!-- Background Image Change Section -->
      <div class="card">
        <h3>Changer l'image de fond du site</h3>
        <form id="bgUploadForm" enctype="multipart/form-data">
          <input type="file" id="bg_image" name="bg_image" accept="image/*" required>
          <button type="submit">Télécharger et remplacer</button>
        </form>
        <p id="uploadMessage"></p>
      </div>
    </main>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('loginModal');
  const form = document.getElementById('loginForm');
  const app = document.getElementById('app');

  function loadStats() {
    // Charger le nombre de produits
    fetch('../api/produits')
      .then(res => res.json())
      .then(data => {
        const nbProduits = data.data ? data.data.length : 0;
        document.getElementById('nbProduits').textContent = nbProduits;
      })
      .catch(error => {
        console.error("Erreur chargement produits :", error);
        document.getElementById('nbProduits').textContent = "Erreur";
      });

    // Charger le nombre d'utilisateurs
    fetch('../api/contacts')
      .then(res => res.json())
      .then(data => {
        const nbUsers = data.data ? data.data.length : 0;
        document.getElementById('nbContacts').textContent = nbUsers;
      })
      .catch(error => {
        console.error("Erreur chargement utilisateurs :", error);
        document.getElementById('nbContacts').textContent = "Erreur";
      });
  }

  if (adminLoggedIn) {
    modal.style.display = 'none';
    app.style.display = 'block';
    loadStats(); // ✅ appel ici si déjà connecté
  } else {
    modal.style.display = 'flex';
  }

  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const btnText = document.getElementById('btnText');
    const loader = document.getElementById('loader');
    const loginBtn = document.getElementById('loginBtn');

    // Show loader and hide text
    btnText.style.display = 'none';
    loader.style.display = 'block';
    loginBtn.disabled = true;

    try {
      const res = await fetch('controller/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
      });

      const result = await res.json(); // ✅ ici on attend un JSON
      console.log(result);

      if (!result.error) {
        alert('Connexion réussie 🎉');
        window.location.reload(); // Recharge pour activer session
      } else {
        alert('Erreur : ' + result.issues);
        // Hide loader and show text on error
        btnText.style.display = 'inline';
        loader.style.display = 'none';
        loginBtn.disabled = false;
      }
    } catch (err) {
      console.error(err);
      alert("Erreur de connexion au serveur.");
      // Hide loader and show text on error
      btnText.style.display = 'inline';
      loader.style.display = 'none';
      loginBtn.disabled = false;
    }
  });

  // Background image upload handler
  const bgUploadForm = document.getElementById('bgUploadForm');
  if (bgUploadForm) {
    bgUploadForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData();
      const fileInput = document.getElementById('bg_image');
      formData.append('bg_image', fileInput.files[0]);

      const messageEl = document.getElementById('uploadMessage');
      messageEl.textContent = 'Téléchargement en cours...';

      try {
        const res = await fetch('upload_bg.php', {
          method: 'POST',
          body: formData
        });

        const result = await res.json();
        if (result.success) {
          messageEl.textContent = result.success;
          messageEl.style.color = 'green';
          fileInput.value = ''; // Reset the input
        } else {
          messageEl.textContent = result.error;
          messageEl.style.color = 'red';
        }
      } catch (err) {
        console.error(err);
        messageEl.textContent = 'Erreur lors du téléchargement.';
        messageEl.style.color = 'red';
      }
    });
  }
});
</script>

</body>
</html>
