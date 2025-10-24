document.addEventListener('DOMContentLoaded', () => {
  const modal      = document.getElementById('loginModal');
  const title      = document.getElementById('formTitle');
  const loginForm  = document.getElementById('loginForm');
  const resetForm  = document.getElementById('resetForm');
  const forgotLink = document.getElementById('forgotLink');
  const backLink   = document.getElementById('backToLogin');
  const app        = document.getElementById('app');

  // 1) On ne montre que le modal tant que l’on n’est pas connecté
  if (app) app.style.display = 'none';
  if (modal) modal.style.display = 'flex';

  // 2) Switch vers “Mot de passe oublié”
  forgotLink.onclick = e => {
    e.preventDefault();
    title.textContent    = 'Réinitialiser le mot de passe';
    loginForm.style.display = 'none';
    resetForm.style.display = 'block';
  };

  // 3) Retour au login
  backLink.onclick = e => {
    e.preventDefault();
    title.textContent    = 'Connexion Administrateur';
    resetForm.style.display = 'none';
    loginForm.style.display = 'block';
  };

  // 4) Soumission login
  loginForm.onsubmit = e => {
    e.preventDefault();
    const email = loginForm.email.value;
    const pwd   = loginForm.password.value;
    // ← ici votre propre appel API / vérif
    if (email==='admin@mondomaine.com' && pwd==='votreMDP') {
      modal.style.display = 'none';  // enlève le modal
      app.style.display   = 'block'; // montre #app
    }
    else alert('Email ou mot de passe incorrect.');
  };

  // 5) Soumission reset
  resetForm.onsubmit = e => {
    e.preventDefault();
    const mail = resetForm.resetEmail.value;
    // appel AJAX vers backend pour envoyer email…
    alert(`Lien envoyé à ${mail}`);
    // on revient au login
    backLink.click();
  };
});
