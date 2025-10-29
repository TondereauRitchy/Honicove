<?php include 'load.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Honicove</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Minimal checkout-specific layout using existing style.css tokens */
    .checkout-container { max-width: 1100px; margin: 100px auto; padding: 0 16px; display: grid; grid-template-columns: 1fr 360px; gap: 32px; }
    .checkout-section { background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 20px; }
    .checkout-section h2 { margin: 0 0 16px; font-size: 20px; letter-spacing: .02em; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .field { display: flex; flex-direction: column; margin-bottom: 12px; }
    .field label { font-size: 12px; text-transform: uppercase; color: #333; margin-bottom: 6px; letter-spacing: .06em; }
    .field input, .field select, .field textarea { border: 1px solid #ddd; border-radius: 6px; padding: 10px 12px; font-size: 14px; }
    .order-summary { position: sticky; top: 16px; }
    .summary-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
    .summary-item img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; }
    .summary-item .meta { flex: 1; }
    .summary-item .price { white-space: nowrap; font-weight: 600; }
    .summary-row { display: flex; justify-content: space-between; margin-top: 10px; font-size: 14px; }
    .summary-row.total { font-weight: 700; font-size: 16px; border-top: 1px solid #eaeaea; padding-top: 10px; }
    .btn-primary { display: inline-block; width: 100%; background: #111; color: #fff; padding: 12px 16px; border-radius: 6px; border: none; cursor: pointer; letter-spacing: .06em; }
    .stripe-payment-btn { display: inline-block; width: 100%; background: #635bff; color: #fff; padding: 12px 16px; border-radius: 6px; border: none; cursor: pointer; letter-spacing: .06em; font-weight: 600; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s; }
    .stripe-payment-btn:hover { background: #5a52d1; }
    .coupon { display: flex; gap: 8px; margin-top: 12px; }
    .coupon input { flex: 1; }
    .color-display { display: flex; align-items: center; gap: 8px; margin-bottom: 4px; }
    .color-label { font-size: 14px; color: #666; }
    .color { width: 20px; height: 20px; border-radius: 50%; border: 1px solid #ccc; display: inline-block; }
    /* Header overrides: make links and icons black, cart icon too */
    .site-header {background: #fff;}
    .site-header a { color: #000 !important; }
    .site-header a svg { color: #000 !important; stroke: #000 !important; fill: none; }
    .site-header .brand a, .site-header .main-nav a { color: #000 !important; }
    .site-header .Card-icon { color: #000 !important; border-color: #000 !important; }
    .site-header .Card-icon span { color: #000 !important; }
    /* Side menu text in white */
    .side-menu h3, .side-menu a { color: #fff !important; }
    /* Override for back-link SVG */
    .back-link svg { stroke: white !important; }
    @media (max-width: 900px) { .checkout-container { grid-template-columns: 1fr; } .order-summary { position: static; } }
  </style>
</head>
<body class="checkout-page">
  <div class="top-bar">
    <th>
      Free Domestic and International Shipping
    </th>
  </div>
  <header class="site-header" style="display: flex; justify-content: center; align-items: center; position: relative; background: #7A0B1A;">
    <a href="shopping-bag.php" class="back-link" style="position: absolute; left: 0; display: flex; align-items: center; gap: 8px; color: #fff !important; text-decoration: none;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="stroke: white !important;">
        <path d="M19 12H5M12 19l-7-7 7-7"/>
      </svg>
      Back to Shopping Bag
    </a>
    <div class="logo-primary" id="header-logo2">
      <a href="index.php"><img src="logo/Secondary Mark, white.png" alt="Honicove Logo" class="logo-mark"></a>
    </div>
  </header>

  <main class="checkout-container">
    <section class="checkout-section">
      <h2>Informations de livraison</h2>
      <form id="checkout-form">
        <div class="field-row">
          <div class="field">
            <label for="firstName">Prénom</label>
            <input id="firstName" name="firstName" autocomplete="given-name" required>
          </div>
          <div class="field">
            <label for="lastName">Nom</label>
            <input id="lastName" name="lastName" autocomplete="family-name" required>
          </div>
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" autocomplete="email" required>
        </div>
        <div class="field">
          <label for="phone">Téléphone</label>
          <input id="phone" name="phone" type="tel" autocomplete="tel">
        </div>
        <div class="field">
          <label for="address">Adresse</label>
          <input id="address" name="address" autocomplete="address-line1" required>
        </div>
        <div class="field">
          <label for="address2">Complément d'adresse (optionnel)</label>
          <input id="address2" name="address2" autocomplete="address-line2">
        </div>
        <div class="field-row">
          <div class="field">
            <label for="city">Ville</label>
            <input id="city" name="city" autocomplete="address-level2" required>
          </div>
          <div class="field">
            <label for="zip">Code Postal</label>
            <input id="zip" name="zip" autocomplete="postal-code" required>
          </div>
        </div>
        <div class="field-row">
          <div class="field">
            <label for="country">Pays</label>
            <select id="country" name="country" autocomplete="country" required>
              <option value="">Sélectionner</option>
              <option value="FR">France</option>
              <option value="BE">Belgique</option>
              <option value="CH">Suisse</option>
              <option value="CA">Canada</option>
              <option value="US">United States</option>
            </select>
          </div>
          <div class="field">
            <label for="state">État/Province</label>
            <input id="state" name="state" autocomplete="address-level1">
          </div>
        </div>

       
        <button type="submit" class="stripe-payment-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px;">
            <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 3.468.991 3.468 2.381 0 .255-.039.51-.098.734l1.459.673c.125-.44.191-.928.191-1.407C17.641 6.172 15.469 4.95 12.5 4.95c-2.07 0-3.75.95-3.75 2.42 0 1.437 1.062 2.239 3.125 2.962 2.229.781 2.875 1.547 2.875 2.625 0 1.0-.891 1.406-2.109 1.406-1.625 0-3.125-.734-3.281-2.484l-1.578.672c.234 2.406 1.719 3.457 4.859 3.457 2.422 0 3.828-.953 3.828-2.516-.016-1.562-.891-2.265-2.916-3.031z" fill="white"/>
          </svg>
          Payer avec Stripe
        </button>
      </form>
    </section>

    <aside class="checkout-section order-summary">
      <h2>Récapitulatif</h2>
      <div id="summary-items"></div>
      <div class="coupon">
        <input id="coupon" placeholder="Code promo">
        <button id="apply-coupon" class="btn-primary" type="button" style="width:auto; padding: 10px 14px;">Appliquer</button>
      </div>
      <div class="summary-row"><span>Sous-total</span><span id="subtotal">$0.00</span></div>
      <div class="summary-row"><span>Livraison</span><span id="shipping">$0.00</span></div>
      <div class="summary-row"><span>Taxe</span><span id="tax">$0.00</span></div>
      <div class="summary-row total"><span>Total</span><span id="total">$0.00</span></div>
    </aside>
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
              <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05 0-12.07z"/>
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
          <a href="accountsetting.php">Account Settings</a>
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

    // Update menu on page load
    document.addEventListener('DOMContentLoaded', updateAccountMenu);

    document.getElementById('year').textContent = new Date().getFullYear();

    // Checkout logic: pull cart items from localStorage first, then sync with API
    function getUserIdentifier() {
      const userId = localStorage.getItem('user_id');
      let sessionId = localStorage.getItem('session_id');
      if (!sessionId) {
        sessionId = 'guest_' + Date.now();
        localStorage.setItem('session_id', sessionId);
      }
      return { userId, sessionId };
    }

    async function fetchCart() {
      const { sessionId } = getUserIdentifier();
      // Essayer d'abord depuis localStorage
      const localCart = localStorage.getItem('cartItems');
      if (localCart) {
        try {
          const parsedCart = JSON.parse(localCart);
          if (Array.isArray(parsedCart)) {
            console.log('Using cart from localStorage');
            return { data: parsedCart, error: false };
          }
        } catch (e) {
          console.warn('Invalid localStorage cart data, falling back to API');
        }
      }

      // Fallback vers API
      try {
        const res = await fetch(`api/public/index.php?route=/carts?session_id=${encodeURIComponent(sessionId)}`);
        if (!res.ok) throw new Error('Cart fetch failed');
        const apiData = await res.json();
        // Sauvegarder en localStorage pour cohérence
        if (apiData.data) localStorage.setItem('cartItems', JSON.stringify(apiData.data));
        return { data: apiData.data, error: false };
      } catch (e) {
        console.warn('Cart not available from API, showing error.', e);
        return { data: [], error: true };
      }
    }

    function money(n) { return (n || 0).toLocaleString(undefined, { style: 'currency', currency: 'USD' }); }

    // Fonction pour mapper les noms de couleurs français aux noms de couleurs CSS anglais
    function getColorValue(color) {
      const colorMap = {
        'rouge': 'red',
        'bleu': 'blue',
        'vert': 'green',
        'noir': 'black',
        'blanc': 'white',
        'gris': 'gray',
        'jaune': 'yellow',
        'orange': 'orange',
        'violet': 'purple',
        'rose': 'pink',
        'marron': 'brown',
        'beige': 'beige',
        'crème': 'cream',
        'argent': 'silver',
        'or': 'gold',
        'teal': 'teal',
        'cyan': 'cyan',
        'indigo': 'indigo',
        'lime': 'lime',
        // Ajouter d'autres mappings si nécessaire
      };
      return color.startsWith('#') ? color : (colorMap[color.toLowerCase()] || 'gray');
    }

    function renderSummary(items) {
      const container = document.getElementById('summary-items');
      container.innerHTML = '';
      let subtotal = 0;
      if (!items || !items.length) {
        container.innerHTML = '<p>Votre panier est vide.</p>';
      } else {
        items.forEach((it) => {
          const price = Number(it.price || it.product_price || 0);
          const qty = Number(it.quantity || 1);
          subtotal += price * qty;
          const img = it.image ? `uploads/${it.image}` : (it.product && it.product.image_1 ? `uploads/${it.product.image_1}` : 'uploads/card1.jpg');
          const name = it.product_name || (it.product && it.product.name) || it.name || 'Article';
          const colorDisplay = it.color ? `<div class="color-display"><span class="color-label">Couleur:</span><span class="color" style="background-color: ${getColorValue(it.color)};"></span></div>` : '';
          const size = it.size ? ` • ${it.size}` : '';
          const row = document.createElement('div');
          row.className = 'summary-item';
          row.innerHTML = `
            <img src="${img}" alt="${name}">
            <div class="meta">
              <div style="font-weight:600;">${name}</div>
              ${colorDisplay}
              <div style="font-size:12px;color:#666">Qté: ${qty}${size}</div>
            </div>
            <div class="price">${money(price * qty)}</div>
          `;
          container.appendChild(row);
        });
      }
      const shipping = subtotal > 50 ? 0 : 4.99;
      const tax = subtotal * 0.2; // 20% TVA example
      const total = subtotal + shipping + tax;
      document.getElementById('subtotal').textContent = money(subtotal);
      document.getElementById('shipping').textContent = money(shipping);
      document.getElementById('tax').textContent = money(tax);
      document.getElementById('total').textContent = money(total);
    }

    window.addEventListener('DOMContentLoaded', async () => {
      const cart = await fetchCart();
      const items = cart && cart.data && (cart.data.items || cart.data) || [];
      if (cart.error) {
        // Afficher un message d'erreur si le panier ne peut pas être chargé
        const container = document.getElementById('summary-items');
        container.innerHTML = '<p style="color: red;">Erreur : Impossible de charger le panier. Veuillez revenir à la page Shopping Bag.</p>';
        return;
      }
      if (!items || items.length === 0) {
        // Afficher un message si le panier est vide
        const container = document.getElementById('summary-items');
        container.innerHTML = '<p>Votre panier est vide.</p>';
        return;
      }
      renderSummary(items);
    });

    document.getElementById('apply-coupon').addEventListener('click', () => {
      const code = (document.getElementById('coupon').value || '').trim();
      if (!code) return;
      // simple demo: 10% off code "WELCOME10"
      if (code.toUpperCase() === 'WELCOME10') {
        const subtotalEl = document.getElementById('subtotal');
        const current = Number(subtotalEl.textContent.replace(/[^0-9.-]+/g, '')) || 0;
        const newSubtotal = current * 0.9;
        subtotalEl.textContent = money(newSubtotal);
        const shipping = newSubtotal > 50 ? 0 : 4.99;
        const tax = newSubtotal * 0.2;
        const total = newSubtotal + shipping + tax;
        document.getElementById('shipping').textContent = money(shipping);
        document.getElementById('tax').textContent = money(tax);
        document.getElementById('total').textContent = money(total);
      }
    });

    document.getElementById('checkout-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const user = JSON.parse(localStorage.getItem('user'));
      if (!user) {
        alert('Vous devez être connecté pour finaliser l\'achat.');
        window.location.href = 'sign.php';
        return;
      }
      const userId = user.id;
      const sessionId = localStorage.getItem('session_id') || ('guest_' + Date.now());
      const form = new FormData(e.currentTarget);
      const payload = Object.fromEntries(form.entries());
      const order = {
        ...payload,
        session_id: sessionId,
        user_id: userId
      };
      try {
        const res = await fetch('api/public/index.php?route=/orders', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(order) });
        const data = await res.json();
        console.log('pay', data);

        if (!res.ok) throw new Error(data.message || 'Erreur de commande');
        window.location.href = data.data.payment_intent.url;
      } catch (err) {
        alert('Impossible de finaliser la commande pour le moment.');
        console.error(err);
      }
    });
  </script>
</body>
</html>