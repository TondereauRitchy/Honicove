<?php include 'load.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>S'inscrire - Honicove</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="sign-page">
  <div class="top-bar">
    <th>
      Free Domestic and International Shipping
    </th>
  </div>
  <header class="site-header">
    <nav class="brand" aria-label="Brand">
    <a href="#" onclick="toggleSideMenu(event)" aria-label="Shop">Shop</svg></a>
     <a href="blog.php" aria-label="Our Story">Blog</a>
     <a href="about.php" aria-label="About">About</a>
    </nav>


    <!-- Side Menu Backdrop -->
    <div id="side-menu-backdrop" class="side-menu-backdrop" onclick="closeSideMenu()"></div>

    <!-- Side Menu Overlay -->
    <div id="side-menu" class="side-menu">
      <button class="close-menu" onclick="closeSideMenu()">&times;</button>
      <h3 >Shop</h3>
     <div class="overlay">
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">new arrivals</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">clothing</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">mats</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">weights</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">accessories</a>

     </div>
    </div>

    <div class="logo-primary" id="header-logo2">
      <a href="index.php"><img src="logo/Secondary Mark, Black.png" alt="Honicove Logo" class="logo-mark"></a>
    </div>

    <nav class="main-nav" aria-label="Main navigation">
      <a href="#re" onclick="toggleSearch(event)" aria-label="Search"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg></a>
      <div class="search-bar" id="searchBar" style="display:none;">
        <input type="text" placeholder="Rechercher..." aria-label="Barre de recherche" />
      </div>
      <div class="account-container">
        <a href="#" onclick="toggleAccountDropdown(event)" aria-label="Account"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></a>
        <div id="account-dropdown" class="account-dropdown">
          <ul class="account-menu">
            <a href="sign.php" onclick="event.preventDefault(); window.location.href='sign.php';">Sign In</a>
            <a href="#" onclick="event.preventDefault();">My Orders</a>
            <a href="accountsetting.html">Account Settings</a>
            <a href="#" onclick="event.preventDefault();">Address Book</a>
            <a href="#" onclick="event.preventDefault();">Saved Items</a>
          </ul>
        </div>
      </div>
      <div class="cart-container">
        <a href="#" aria-label="Cart"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></a>
        <button class="Card-icon" aria-label="Voir le panier">
          <span>2</span>
        </button>
      </div>
    </nav>
  </header>

  <main class="auth-layout" style="min-height:60vh;display:flex;align-items:center;justify-content:center;padding:40px 16px;">
    <div class="auth-card" style="width:100%;max-width:420px;background:#fff;border:1px solid #eee;border-radius:12px;padding:28px;box-shadow:0 6px 24px rgba(0,0,0,0.08);">
      <h1 style="margin:0 0 8px;font-size:24px;">S'inscrire</h1>
      <p style="margin:0 0 20px;color:#666;">Créez votre compte Honicove</p>

      <?php if(isset($_GET['error'])): ?>
        <div style="background:#ffe6e6;border:1px solid #ffb3b3;color:#b30000;padding:10px 12px;border-radius:8px;margin-bottom:16px;">
          Erreur lors de l'inscription. Veuillez réessayer.
        </div>
      <?php endif; ?>

      <form id="registerForm" method="post" style="display:flex;flex-direction:column;gap:14px;">
        <div>
          <label for="name" style="display:block;margin-bottom:6px;font-weight:600;">Nom complet</label>
          <input type="text" id="name" name="name" required placeholder="Votre nom" style="width:100%;padding:12px 14px;border:1px solid #ddd;border-radius:8px;outline:none;">
        </div>
        <div>
          <label for="email" style="display:block;margin-bottom:6px;font-weight:600;">Email</label>
          <input type="email" id="email" name="email" required placeholder="you@example.com" style="width:100%;padding:12px 14px;border:1px solid #ddd;border-radius:8px;outline:none;">
        </div>
        <div>
          <label for="password" style="display:block;margin-bottom:6px;font-weight:600;">Mot de passe</label>
          <input type="password" id="password" name="password" required placeholder="********" style="width:100%;padding:12px 14px;border:1px solid #ddd;border-radius:8px;outline:none;">
        </div>
        <div>
          <label for="confirm_password" style="display:block;margin-bottom:6px;font-weight:600;">Confirmer le mot de passe</label>
          <input type="password" id="confirm_password" name="confirm_password" required placeholder="********" style="width:100%;padding:12px 14px;border:1px solid #ddd;border-radius:8px;outline:none;">
        </div>
        <button type="submit" style="margin-top:6px;padding:12px 16px;background:#000;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;">S'inscrire</button>
      </form>

      <div style="margin-top:16px;text-align:center;">
        <a href="sign.php" style="color:#333;">Déjà un compte ? Se connecter</a>
      </div>
    </div>
  </main>

  <footer class="site-footer">
  <div class="footer-container">
    <div class="footer-brand">
      <img src="logo/Primary, Black.png" alt="Honicove logo" class="footer-logo">
      <p class="footer-tagline">Redefining Athleisure</p>
    </div>

    <div class="footer-links">
      <div>
        <h4>Shop</h4>
        <a href="#">New Arrivals</a>
        <a href="#">Best Sellers</a>
        <a href="#">Sets</a>
        <a href="#">Accessories</a>
      </div>
      <div>
        <h4>About</h4>
        <a href="#">Our Story</a>
        <a href="#">Sustainability</a>
        <a href="#">Careers</a>
      </div>
      <div>
        <h4>Support</h4>
        <a href="#">FAQs</a>
        <a href="#">Contact</a>
        <a href="#">Returns</a>
      </div>
      <div>
        <h4>Follow us</h4>
        <div class="footer-socials">
          <a href="#" aria-label="Instagram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
          </a>
          <a href="#" aria-label="Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          <a href="#" aria-label="TikTok">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
            </svg>
          </a>
          <a href="#" aria-label="X (Twitter)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© <span id="year"></span> Honicove — All rights reserved.</p>
  </div>
  </footer>
  <script>
    function scrollToSection(id, e){
      if(e) e.preventDefault();
      const el = document.getElementById(id);
      if(!el) return window.scrollTo({top:0, behavior:'smooth'});
      el.scrollIntoView({behavior:'smooth', block:'start'});
    }

    function goHome(e){
      if(e) e.preventDefault();
      window.scrollTo({top:0,behavior:'smooth'});
    }

    function toggleSearch(e) {
      e.preventDefault();
      const searchBar = document.getElementById('searchBar');
      if (searchBar.style.display === 'none' || searchBar.style.display === '') {
        searchBar.style.display = 'block';
      } else {
        searchBar.style.display = 'none';
      }
    }

    function toggleSideMenu(e) {
      e.preventDefault();
      const sideMenu = document.getElementById('side-menu');
      const backdrop = document.getElementById('side-menu-backdrop');
      sideMenu.classList.toggle('open');
      backdrop.style.display = sideMenu.classList.contains('open') ? 'block' : 'none';
    }

    function closeSideMenu() {
      const sideMenu = document.getElementById('side-menu');
      const backdrop = document.getElementById('side-menu-backdrop');
      sideMenu.classList.remove('open');
      backdrop.style.display = 'none';
    }

    function toggleAccountDropdown(e) {
      e.preventDefault();
      const dropdown = document.getElementById('account-dropdown');
      const isOpen = dropdown.classList.contains('show');
      if (isOpen) {
        dropdown.classList.remove('show');
        document.removeEventListener('click', closeAccountDropdown);
      } else {
        dropdown.classList.add('show');
        document.addEventListener('click', closeAccountDropdown);
      }
    }

    function closeAccountDropdown(e) {
      const container = document.querySelector('.account-container');
      const dropdown = document.getElementById('account-dropdown');
      if (!container.contains(e.target)) {
        dropdown.classList.remove('show');
        document.removeEventListener('click', closeAccountDropdown);
      }
    }

    // Function to update account menu based on login status
    function updateAccountMenu() {
      const accountMenu = document.querySelector('.account-menu');
      const user = localStorage.getItem('user');
      if (user) {
        // Logged in: show My Account, My Orders, Account Settings, Address Book, Saved Items, Logout
        accountMenu.innerHTML = `
          <a href="myaccount.html">My Account</a>
          <a href="#" onclick="event.preventDefault();">My Orders</a>
          <a href="accountsetting.html">Account Settings</a>
          <a href="#" onclick="event.preventDefault();">Address Book</a>
          <a href="#" onclick="event.preventDefault();">Saved Items</a>
          <a href="#" onclick="logout(event)">Logout</a>
        `;
      } else {
        // Not logged in: show only Sign In
        accountMenu.innerHTML = `
          <a href="sign.php">Sign In</a>
        `;
      }
    }

    // Function to handle logout
    function logout(e) {
      e.preventDefault();
      localStorage.removeItem('user');
      window.location.href = 'index.php';
    }

    // Initialize account menu on page load
    document.addEventListener('DOMContentLoaded', function() {
      updateAccountMenu();
    });

    document.getElementById('year').textContent = new Date().getFullYear();

    document.getElementById('registerForm').addEventListener('submit', async function(e) {
      e.preventDefault(); // Empêcher la soumission classique

      const formData = new FormData(this);
      const data = {
        name: formData.get('name'),
        email: formData.get('email'),
        password: formData.get('password'),
        confirm_password: formData.get('confirm_password')
      };

      // Vérification côté client pour la confirmation du mot de passe
      if (data.password !== data.confirm_password) {
        showError('Les mots de passe ne correspondent pas.');
        return;
      }

      try {
        const response = await fetch('http://localhost/dashboard/Honicove-1/api/public/index.php?route=users', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.error) {
          showError(result.message || 'Erreur lors de l\'inscription.');
        } else {
          // Succès : rediriger vers la page de connexion
          window.location.href = 'sign.php?success=1';
        }
      } catch (error) {
        showError('Erreur réseau. Veuillez réessayer.');
      }
    });

    function showError(message) {
      let errorDiv = document.getElementById('error-message');
      if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.id = 'error-message';
        errorDiv.style.cssText = 'background:#ffe6e6;border:1px solid #ffb3b3;color:#b30000;padding:10px 12px;border-radius:8px;margin-bottom:16px;';
        document.querySelector('.auth-card').insertBefore(errorDiv, document.querySelector('form'));
      }
      errorDiv.textContent = message;
      errorDiv.style.display = 'block';
    }
  </script>
</body>
</html>
