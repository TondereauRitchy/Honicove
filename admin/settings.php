<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paramètres du compte</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="admin.css">
</head>
<body>
<?php require('includes/menu.php'); ?>

  <main class="settings-container">
    <h1>Paramètres du compte</h1>
    <form class="settings-form">
      <input type="hidden" id="user_id" value="<?= $_SESSION['id_admin'] ?? '' ?>">
      <label for="email">Nouvel email</label>
      <input type="email" id="email" name="email" required>

      <label for="current-password">Mot de passe actuel</label>
      <input type="password" id="current-password" name="current_password" required>

      <label for="new-password">Nouveau mot de passe</label>
      <input type="password" id="new-password" name="new_password" required>

      <label for="confirm-password">Confirmer le nouveau mot de passe</label>
      <input type="password" id="confirm-password" name="confirm_password" required>

      <button type="submit">Enregistrer les modifications</button>
    </form>
  </main>

  <script>
    document.querySelector('.settings-form').addEventListener('submit', async function (e) {
      e.preventDefault();

      const email = document.getElementById('email').value;
      const current = document.getElementById('current-password').value;
      const nouveau = document.getElementById('new-password').value;
      const confirm = document.getElementById('confirm-password').value;
      const id = document.getElementById('user_id').value;

      if (nouveau !== confirm) {
        alert("Les mots de passe ne correspondent pas.");
        return;
      }

      try {
        const res = await fetch('../api/users/'+id, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            email: email,
            current_password: current,
            new_password: nouveau
          })
        });

        const result = await res.json();

        console.log(result);
        

        if (!result.error) {
          alert("Compte mis à jour avec succès !");
          e.target.reset();
        } else {
          alert("Erreur : " + result.message);
        }
      } catch (err) {
        alert("Erreur réseau ou serveur.");
        console.error(err);
      }
    });
  </script>
</body>
</html>
