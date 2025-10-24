<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Shopping Bag — Honicove</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Site global CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Page-specific minimal styles (kept here to avoid touching your global CSS) -->
  <style>
    :root {
      --text: #111;
      --muted: #666;
      --border: #eaeaea;
      --accent: #000;
    }

    body { color: var(--text); background:#fff; font-family: 'Red Hat Display', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }

    .bag-wrap {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 32px;
    }
    .main-nav a{
      color: black;

    }

    /* Title */
    .bag-header {
      grid-column: 1 / -1;
      display: flex;
      align-items: baseline;
      justify-content: space-between;
      border-bottom: 1px solid var(--border);
      padding-bottom: 16px;
      margin-bottom: 8px;
    }
    .bag-header h1 { font-size: 28px; letter-spacing: .06em; text-transform: uppercase; }

    /* Left column - line items */
    .bag-items { background:#fff; }

    .bag-item { display: grid; grid-template-columns: 140px 1fr 120px 100px; gap: 20px; padding: 24px 0; border-bottom: 1px solid var(--border); }
    .bag-item:last-child { border-bottom: none; }

    .bag-item .thumb { width: 140px; height: 100px; object-fit: cover; border: 1px solid var(--border); }

    .bag-item .meta h3 { font-size: 20px; margin: 0 0 8px; }
    .bag-item .meta p { margin: 0; color: var(--muted); font-size: 14px; line-height: 1.6; }

    .color-display { display: flex; align-items: center; gap: 8px; margin-bottom: 4px; }
    .color-label { font-size: 14px; color: var(--muted); }
    .color { width: 20px; height: 20px; border-radius: 50%; border: 1px solid #ccc; display: inline-block; }

    .bag-item .availability { margin-top: 12px; font-size: 12px; letter-spacing: .12em; color: var(--text); }

    .bag-item .actions { margin-top: 10px; display:flex; gap:14px; font-size: 12px; text-transform: uppercase; }
    .bag-item .actions a { color: var(--text); text-decoration: none; border-bottom: 1px solid var(--text); padding-bottom: 2px; }

    .bag-item .qty { display: flex; align-items: center; gap: 10px; }
    .bag-item .qty label { font-size: 12px; letter-spacing: .12em; color: var(--muted); }
    .bag-item select { padding: 6px 10px; border: 1px solid var(--border); background:#fff; }

    .bag-item .price { font-size: 18px; text-align: right; }

    /* Right column - summary */
    .bag-summary { border: 1px solid var(--border); padding: 18px; border-radius: 6px; position: sticky; top: 24px; height: max-content; background: #fff; }
    .bag-summary h3 { font-size: 12px; letter-spacing: .14em; margin: 0 0 12px; }

    .summary-row { display:flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--border); }
    .summary-row:last-of-type { border-bottom: none; }

    .summary-row .muted { color: var(--muted); font-size: 14px; }
    .summary-total { display:flex; justify-content: space-between; align-items: center; padding: 16px 0; font-size: 22px; }

    .summary-actions { display:flex; flex-direction: column; gap: 10px; margin-top: 8px; }
    .summary-actions .btn { padding: 14px 18px; border: 1px solid #693c3cff; border-radius: 0; cursor: pointer; text-align:center; font-weight: 600; letter-spacing: .06em; }
    .summary-actions .btn.black { background:#7A0B1A; color:#fff; border-color:#7A0B1A; }
    .summary-actions .btn.white { background:#fff; color:#000; }

    .summary-note { font-size: 12px; color: var(--muted); line-height: 1.6; margin-top: 8px; }

    .summary-toggle { display:flex; align-items:center; justify-content: space-between; cursor:pointer; padding: 10px 0; border-top: 1px solid var(--border); }

    .paypal { display:flex; align-items:center; justify-content:center; gap:10px; border:1px solid var(--border); padding: 12px; font-weight: 600; }
    .paypal img { height: 18px; }

    /* Header hover styles */
    .site-header .brand a,
    .site-header .main-nav a {
      padding: 8px 12px;
      border-radius: 6px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

   .site-header .brand a:hover,
    .site-header .main-nav a:hover {
      background-color: #7A0B1A;
      color: white;
    }
    

    /* Responsive */
    @media (max-width: 980px) {
      .bag-wrap { grid-template-columns: 1fr; }
      .bag-item { grid-template-columns: 100px 1fr; grid-template-areas: 'img name' 'img name' 'qty price'; }
      .bag-item .thumb { width: 100px; height: 80px; }
      .bag-item .qty { grid-area: qty; margin-top: 8px; }
      .bag-item .price { grid-area: price; text-align: left; margin-top: 8px; }
    }
  </style>
</head>
<body class="shopping-bag-page">

  <div class="top-bar">
    <div class="contenair">
      <h4>Free Domestic and International Shipping</h4>
    </div>
  </div>

  <header class="site-header" style="background: white; color: black;">
    <nav class="brand" aria-label="Brand">
      <a href="index.php" aria-label="Shop" style="color: black;">Shop</a>
      <a href="blog.php" aria-label="Our Story" style="color: black;">Blog</a>
      <a href="about.php" aria-label="About" style="color: black;">About</a>
    </nav>

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
            <a href="#" onclick="event.preventDefault();">Sign In</a>
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

  <main class="bag-wrap" style="margin-top: 10%;">
    <!-- <div class="bag-header">
      <h1>Shopping Bag</h1>
      <div class="muted">USCART413774662</div>
    </div> -->

    <!-- Left: Items -->
    <section class="bag-items" id="bag-items">
      <!-- Articles du panier chargés dynamiquement -->
      <!--
      <article class="bag-item" data-unit-price="980">
        <img class="thumb" src="logo/card1.jpg" alt="Product image">
        <div class="meta">
          <h3>Women's Gucci Shift sneaker</h3>
          <p>Style# 857963 AAF10 9845</p>
          <p>Variation: light beige GG canvas</p>
          <p>Size: 37.5 = 7.5 US</p>
          <div class="availability">AVAILABLE</div>
          <div class="actions">
            <a href="#">Edit</a>
            <a href="#" id="remove-item">Remove</a>
            <a href="#">Saved Items</a>
          </div>
        </div>
        <div class="qty">
          <label for="qty-select">QTY:</label>
          <select id="qty-select">
            <option value="1">1</option>
            <option value="2" selected>2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <div class="price" id="line-price">$980</div>
      </article>
      -->
    </section>

    <!-- Right: Summary -->
    <aside class="bag-summary" aria-label="Order summary">
      <h3>ORDER SUMMARY</h3>
      <div class="summary-row"><span class="muted">Subtotal</span><strong id="summary-subtotal">$1,960</strong></div>
      <div class="summary-row"><span class="muted">Shipping</span><span class="muted">Free (Premium Express)</span></div>
      <div class="summary-row"><span class="muted">Estimated Tax</span><a href="#" id="calc-tax">Calculate</a></div>
      <div class="summary-total"><span>Estimated Total</span><strong id="summary-total">$1,960</strong></div>

      <div class="summary-toggle">
        <span>VIEW DETAILS</span>
        <span>+</span>
      </div>
      <p class="summary-note">You will be charged at the time of shipment. If this is a personalized or made-to-order purchase, you will be charged at the time of purchase.</p>

      <div class="summary-actions">
        <button class="btn black" id="checkout">CHECKOUT</button>
        <!-- <div class="paypal">
          <span>PAY WITH</span>
          <img src="https://www.paypalobjects.com/webstatic/icon/pp258.png" alt="PayPal">
        </div> -->
      </div>
    </aside>
  </main>

  <script>
    (function(){
      const formatter = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
      const bagItemsEl = document.getElementById('bag-items');
      const subtotalEl = document.getElementById('summary-subtotal');
      const totalEl = document.getElementById('summary-total');
      const calcTaxLink = document.getElementById('calc-tax');

      let taxRate = 0; // 0.08 when calculated
      let cartItems = []; // Stockage des articles du panier

      // Fonction pour obtenir user_id ou session_id (à adapter selon votre système d'authentification)
      function getUserIdentifier() {
        // Exemple : récupérer depuis localStorage ou session
        const userId = localStorage.getItem('user_id');
        let sessionId = localStorage.getItem('session_id');
        if (!sessionId) {
          sessionId = 'guest_' + Date.now();
          localStorage.setItem('session_id', sessionId); // Persister session_id dans localStorage
        }
        return { userId, sessionId };
      }

      // Charger le panier depuis l'API
      async function loadCart() {
        const { userId, sessionId } = getUserIdentifier();
        const params = new URLSearchParams();
        if (userId) params.append('user_id', userId);
        if (sessionId) params.append('session_id', sessionId);

        console.log('Loading cart with userId:', userId, 'sessionId:', sessionId);

        try {
          const response = await fetch(`api/public/index.php?route=carts&${params}`);
          const data = await response.json();
          console.log('Cart API response:', data);
          if (data.error) {
            console.error('Erreur chargement panier:', data.message);
            return;
          }
          cartItems = data.data || [];
          console.log('Cart items loaded:', cartItems);
          // Sauvegarder le panier en localStorage pour le transfert vers checkout
          localStorage.setItem('cartItems', JSON.stringify(cartItems));
          renderCart();
        } catch (error) {
          console.error('Erreur réseau:', error);
        }
      }

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

      // Rendre les articles du panier
      function renderCart() {
        bagItemsEl.innerHTML = '';
        let subtotal = 0;

        if (cartItems.length === 0) {
          bagItemsEl.innerHTML = '<p>Votre panier est vide.</p>';
          subtotalEl.textContent = formatter.format(0);
          totalEl.textContent = formatter.format(0);
          return;
        }

        cartItems.forEach(item => {
          const itemTotal = parseFloat(item.price) * item.quantity;
          subtotal += itemTotal;

          const itemEl = document.createElement('article');
          itemEl.className = 'bag-item';
          itemEl.setAttribute('data-cart-id', item.id);
          itemEl.innerHTML = `
            <img class="thumb" src="uploads/${item.image || item.product_image || 'card1.jpg'}" alt="Product image">
            <div class="meta">
              <h3>${item.product_name || 'Produit'}</h3>
              <div class="color-display">
                <span class="color-label">Couleur:</span>
                <span class="color" style="background-color: ${item.color ? getColorValue(item.color) : '#ccc'};" title="${item.color || 'N/A'}"></span>
              </div>
              <p>Taille: ${item.size || 'N/A'}</p>
              <div class="availability">AVAILABLE</div>
              <div class="actions">
                <a href="#" class="edit-item">Edit</a>
                <a href="#" class="remove-item" data-id="${item.id}">Remove</a>
                <a href="#">Saved Items</a>
              </div>
            </div>
            <div class="qty">
              <label for="qty-select-${item.id}">QTY:</label>
              <select id="qty-select-${item.id}" class="qty-select" data-id="${item.id}">
                ${[1,2,3,4,5].map(q => `<option value="${q}" ${q == item.quantity ? 'selected' : ''}>${q}</option>`).join('')}
              </select>
            </div>
            <div class="price">${formatter.format(itemTotal)}</div>
          `;
          bagItemsEl.appendChild(itemEl);
        });

        // Calculer et afficher les totaux
        const tax = Math.round(subtotal * taxRate);
        subtotalEl.textContent = formatter.format(subtotal);
        totalEl.textContent = formatter.format(subtotal + tax);

        // Attacher les événements
        attachEventListeners();
      }

      // Attacher les événements aux éléments dynamiques
      function attachEventListeners() {
        // Changement de quantité
        document.querySelectorAll('.qty-select').forEach(select => {
          select.addEventListener('change', async function() {
            const cartId = this.getAttribute('data-id');
            const newQty = this.value;
            await updateCartItem(cartId, { quantity: newQty });
          });
        });

        // Suppression d'article
        document.querySelectorAll('.remove-item').forEach(link => {
          link.addEventListener('click', async function(e) {
            e.preventDefault();
            const cartId = this.getAttribute('data-id');
            await deleteCartItem(cartId);
          });
        });
      }

      // Mettre à jour un article du panier
      async function updateCartItem(cartId, updates) {
        const { userId, sessionId } = getUserIdentifier();
        try {
          const response = await fetch(`api/public/index.php?route=carts/${cartId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ...updates, user_id: userId, session_id: sessionId })
          });
          const data = await response.json();
          if (data.error) {
            alert('Erreur mise à jour: ' + data.message);
            return;
          }
          // Recharger le panier
          await loadCart();
        } catch (error) {
          console.error('Erreur mise à jour:', error);
        }
      }

      // Supprimer un article du panier
      async function deleteCartItem(cartId) {
        const { userId, sessionId } = getUserIdentifier();
        try {
          const response = await fetch(`api/public/index.php?route=carts/${cartId}`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: userId, session_id: sessionId })
          });
          const data = await response.json();
          if (data.error) {
            alert('Erreur suppression: ' + data.message);
            return;
          }
          // Recharger le panier
          await loadCart();
        } catch (error) {
          console.error('Erreur suppression:', error);
        }
      }

      // Calcul de la taxe
      calcTaxLink?.addEventListener('click', function(e){
        e.preventDefault();
        taxRate = taxRate === 0 ? 0.08 : 0;
        calcTaxLink.textContent = taxRate ? 'Remove' : 'Calculate';
        renderCart();
      });

      // Handle CHECKOUT button click
      document.getElementById('checkout').addEventListener("click", () => {
        window.location.href = 'checkout.php';
      });

      // Charger le panier au chargement de la page
      loadCart();
    })();
  </script>
</body>
</html>
