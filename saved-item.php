<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Honicove — Saved Items</title>

  <link href="https://fonts.googleapis.com/css2?family=PT+Futura+Condensed:wght@400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">

  <style>
    /* Lightweight page-specific styling to mimic the reference layout */
    body{overflow-x: hidden;}
    .saved-items-hero{padding:40px 16px;text-align:center}
    .saved-items-hero h1{letter-spacing:.2rem;font-weight:600;margin:8px 0}
    .saved-items-hero p{color:#444;margin:0}
    .saved-grid{display:grid;grid-template-columns:1fr;gap: 10px;max-width:1200px;margin:32px auto 300px auto}
    .card{background:#fff;border:1px solid #e8e8e8;width:300px;height:300px;position:relative}
    .card-top{position:absolute;top:0;right:0;padding:10px}
    .card-fav{background:none;border:none;cursor:pointer}
    .card img{max-width:100%;height:100%;display:block;margin:0 auto;padding-top:50px}
    .card h4{font-weight:600;margin:10px 0 6px 0;text-align:center}
    .card .subtitle{color:#666;font-size:.95rem;margin:0;text-align:center}
    .card .price{margin:0;font-weight:600;text-align:center}
    .card .card-bottom { display: flex; justify-content: center; align-items: center; gap: 10px; margin: 0 0 6px 0; }
    .card-actions { display: flex; justify-content: center; gap: 15px; margin: 10px 0; }
    .btn-primary{background:#000;color:#fff;border:none;padding:10px 18px;cursor:pointer}
    .btn-primary:hover { transform: scale(0.95); transition: transform 0.2s ease; }
    .btn-outline{background:#fff;color:#000;border:1px solid #000;padding:10px 18px;cursor:pointer;display:flex;align-items:center;gap:5px}
    .section-title {
  text-align: center;
  display: flex;
  justify-content: center;
  width: 100%;
}

.section-title h2 {
  margin: 0 auto;
  text-align: center;
  display: block;
}

    .recommend-grid{display:grid;grid-template-columns:repeat(1,1fr);gap:10px;max-width:1200px;margin:10px auto;}
    .recommend-card{border:1px solid #e8e8e8}
    .recommend-card .media{background:#f6f6f6;display:flex;align-items:center;justify-content:center;min-height:220px}
    .recommend-card .media img{max-width:100%;height:auto}
    .recommend-card .body{padding:14px;text-align:center}
    .recommend-card .price{margin-top:4px;color:#444}
    /* Share modal */
    .share-header{text-align:center;margin-bottom:8px;color:#666;font-size:.9rem;letter-spacing:.05em}
    .share-title{font-family:'Playfair Display', serif;text-align:center;margin:6px 0 18px 0;font-weight:600}
    .share-icons{display:flex;gap:26px;justify-content:center;margin:10px 0 6px 0}
    .share-icons button{background:#fff;border:1px solid #d8d8d8;border-radius:50%;width:76px;height:76px;display:flex;align-items:center;justify-content:center;cursor:pointer}
    .share-icons button:hover{border-color:#000}
    .share-labels{display:flex;gap:26px;justify-content:center;color:#333;font-size:.95rem;margin-bottom:18px}
    .share-copy{display:flex;align-items:center;gap:10px;background:#f5f5f5;border:1px solid #eee;padding:14px;border-radius:6px}
    .share-copy input{flex:1;border:none;background:transparent;outline:none;font-size:.95rem}
    /* .modal.share{height: 100%;} */
    .modal.share .modal-content{max-width:640px; position: absolute; top: 100%; left: 50%; transform: translate(-50%, -50%)}
    @media(min-width:760px){.saved-grid{grid-template-columns:repeat(4,1fr)}.recommend-grid{grid-template-columns:repeat(4,1fr)}}
  </style>
</head>
<body class="saved-items-page">

  <div class="top-bar">
    <th>
      Free Domestic and International Shipping
    </th>
  </div>
  <header class="site-header">
    <nav class="brand" aria-label="Brand">
      <a href="#" onclick="toggleSideMenu(event)" aria-label="Shop">Shop</a>
      <a href="blog.php" aria-label="Our Story">Blog</a>
      <a href="about.php" aria-label="About">About</a>
    </nav>

    <div id="side-menu-backdrop" class="side-menu-backdrop" onclick="closeSideMenu()"></div>

    <div id="side-menu" class="side-menu">
      <button class="close-menu" onclick="closeSideMenu()">&times;</button>
      <h3>Shop</h3>
      <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">new arrivals</a>
      <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">clothing</a>
      <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">mats</a>
      <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">weights</a>
      <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">accessories</a>
    </div>

    <div class="logo-primary" id="header-logo2">
      <a href="index.php"><img src="logo/Secondary Mark, Black.png" alt="Honicove Logo" class="logo-mark"></a>
    </div>

    <nav class="main-nav" aria-label="Main navigation">
      <a href="#" onclick="toggleSearch(event)" aria-label="Search"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg></a>
      <div class="search-bar" id="searchBar" style="display:none;">
        <input type="text" placeholder="Rechercher..." aria-label="Barre de recherche" />
      </div>
      <div class="account-container">
        <a href="#" onclick="toggleAccountDropdown(event)" aria-label="Account"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></a>
        <div id="account-dropdown" class="account-dropdown">
          <ul class="account-menu">
            <a href="sign.php">Sign In</a>
            <a href="#" onclick="event.preventDefault();">My Orders</a>
            <a href="accountsetting.php">Account Settings</a>
            <a href="#" onclick="event.preventDefault();">Address Book</a>
            <a href="#" onclick="event.preventDefault();">Saved Items</a>
          </ul>
        </div>
      </div>
      <div class="cart-container">
        <a href="#" onclick="openModalAnchored(event)" aria-label="Cart"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></a>
        <button class="Card-icon" onclick="openModalAnchored(event)" aria-label="Voir le panier">
          <span>0</span>
        </button>
      </div>
    </nav>
  </header>

  <main class="wrap">
    <section class="saved-items-hero">
      <h1>SAVED ITEMS</h1>
      <p>You Have 4 Items In Saved Items.</p>
    </section>

    <section class="saved-grid">
      <div class="card">
        <div class="card-top">
          <button class="card-fav" aria-label="Ajouter aux favoris">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>
        <img src="logo/card1.jpg" alt="Shift sneaker">
        <h4>Men's Shift Sneaker</h4>
        <div class="card-bottom">
          <p class="subtitle">Size 6.5 ≈ 7 US</p>
          <p class="price">$980</p>
        </div>
        <div class="card-actions">
          <button class="btn-primary">Add to Bag</button>
          <button class="btn-outline btn-share"> <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98"/><path d="m15.41 6.51-6.82 3.98"/></svg>Share</button>
        </div>
      </div>

      <div class="card">
        <div class="card-top">
          <button class="card-fav" aria-label="Ajouter aux favoris">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>
        <img src="logo/card2.jpg" alt="G75 sneaker">
        <h4>Men's G75 Sneaker</h4>
        <div class="card-bottom">
          <p class="subtitle">Size 9.5 ≈ 10 US</p>
          <p class="price">$920</p>
        </div>
        <div class="card-actions">
          <button class="btn-primary">Add to Bag</button>
          <button class="btn-outline btn-share"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98"/><path d="m15.41 6.51-6.82 3.98"/></svg>Share</button>
        </div>
      </div>

      <div class="card">
        <div class="card-top">
          <button class="card-fav" aria-label="Ajouter aux favoris">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>
        <img src="logo/image1.jpg" alt="Re-Web sneaker">
        <h4>Men's Re-Web Sneaker</h4>
        <div class="card-bottom">
          <p class="subtitle">Size 8.0 ≈ 8.5 US</p>
          <p class="price">$1190</p>
        </div>
        <div class="card-actions">
          <button class="btn-primary">Add to Bag</button>
          <button class="btn-outline btn-share"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98"/><path d="m15.41 6.51-6.82 3.98"/></svg>Share</button>
        </div>
      </div>

      <div class="card">
        <div class="card-top">
          <button class="card-fav" aria-label="Ajouter aux favoris">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>
        <img src="logo/image1.jpg" alt="2.0 sneaker">
        <h4>Men's 2.0 Sneaker</h4>
        <div class="card-bottom">
          <p class="subtitle">Size 7.5 ≈ 8 US</p>
          <p class="price">$1270</p>
        </div>
        <div class="card-actions">
          <button class="btn-primary">Add to Bag</button>
          <button class="btn-outline btn-share"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98"/><path d="m15.41 6.51-6.82 3.98"/></svg>Share</button>
        </div>
      </div>
    </section>

    <div class="section-title">
      <h2>YOU MAY ALSO LIKE</h2>
    </div>
      <section class="recommend-grid">
        <div class="card">
          <div class="card-top">
            <button class="card-fav" aria-label="Ajouter aux favoris">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <img src="logo/image1.jpg" alt="Recommended 1">
          <h4>Men's G75 Sneaker</h4>
          <p class="price">$890</p>
          <div class="color-swatches"></div>
        </div>
        <div class="card">
          <div class="card-top">
            <button class="card-fav" aria-label="Ajouter aux favoris">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <img src="logo/image2.jpg" alt="Recommended 2">
          <h4>Men's G75 Sneaker</h4>
          <p class="price">$920</p>
          <div class="color-swatches"></div>
        </div>
        <div class="card">
          <div class="card-top">
            <button class="card-fav" aria-label="Ajouter aux favoris">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <img src="logo/main.jpg" alt="Recommended 3">
          <h4>Men's Re-Web Sneaker</h4>
          <p class="price">$1190</p>
          <div class="color-swatches"></div>
        </div>
        <div class="card">
          <div class="card-top">
            <button class="card-fav" aria-label="Ajouter aux favoris">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <img src="logo/read.jpg" alt="Recommended 4">
          <h4>Men's 2.0 Sneaker</h4>
          <p class="price">$1270</p>
          <div class="color-swatches"></div>
        </div>
      </section>
  </main>

  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-brand">
        <img src="logo/Primary, Red.png" alt="Honicove logo" class="footer-logo">
        <p class="footer-tagline">Redefining Athleisure</p>
      </div>

      <div class="footer-links">
        <div>
          <h4>Shop</h4>
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
            <a href="#" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
            <a href="#" aria-label="Facebook"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
            <a href="#" aria-label="TikTok"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></a>
            <a href="#" aria-label="X (Twitter)"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© <span id="year"></span> Honicove — All rights reserved.</p>
    </div>
  </footer>

  <div id="cartModal" class="modal">
    <div class="modal-content">
      <button class="close-btn" id="closeModal">&times;</button>
      <div id="dynamic-product-summary"></div>
      <div class="modal-actions">
        <button id="checkout-btn" class="btn black">CHECKOUT</button>
        <a id="view-shopping-bag-btn" class="btn white" href="shopping-bag.php">VIEW SHOPPING BAG</a>
      </div>
    </div>
  </div>

  <div id="shareModal" class="modal share" style="display:none;">
    <div class="modal-content">
      <button class="close-btn" id="closeShareModal">&times;</button>
      <div class="share-header">SHARE THIS</div>
      <h2 id="shareProductTitle" class="share-title"></h2>
      <div class="share-icons">
        <button id="shareFacebook" aria-label="Share on Facebook">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9b9b9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        </button>
        <button id="shareTwitter" aria-label="Share on X">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9b9b9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4l16 16M20 4 4 20"/></svg>
        </button>
        <button id="sharePinterest" aria-label="Share on Pinterest">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9b9b9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 13c0 2 2 3 4 3s4-1 4-3-2-3-4-3"/></svg>
        </button>
      </div>
      <div class="share-labels"><span>Facebook</span><span>Twitter</span><span>Pinterest</span></div>
      <div class="share-copy">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 1 0 7.07 7.07l1.71-1.71"/></svg>
        <input id="shareUrlInput" type="text" readonly value="" />
        <button id="copyShareUrl" class="btn-outline">Copy</button>
      </div>
    </div>
  </div>

  <script>
    function scrollToSection(id, e){ if(e) e.preventDefault(); const el = document.getElementById(id); if(!el) return window.scrollTo({top:0, behavior:'smooth'}); el.scrollIntoView({behavior:'smooth', block:'start'}); }
    function toggleSearch(e){ e.preventDefault(); const s=document.getElementById('searchBar'); s.style.display=(s.style.display==='none'||s.style.display==='')?'block':'none'; }
    function toggleSideMenu(e){ e.preventDefault(); const m=document.getElementById('side-menu'); const b=document.getElementById('side-menu-backdrop'); m.classList.toggle('open'); b.style.display=m.classList.contains('open')?'block':'none'; }
    function closeSideMenu(){ const m=document.getElementById('side-menu'); const b=document.getElementById('side-menu-backdrop'); m.classList.remove('open'); b.style.display='none'; }
    function toggleAccountDropdown(e){ e.preventDefault(); const d=document.getElementById('account-dropdown'); const isOpen=d.classList.contains('show'); if(isOpen){ d.classList.remove('show'); document.removeEventListener('click', closeAccountDropdown);} else { d.classList.add('show'); document.addEventListener('click', closeAccountDropdown);} }
    function closeAccountDropdown(e){ const c=document.querySelector('.account-container'); const d=document.getElementById('account-dropdown'); if(!c.contains(e.target)){ d.classList.remove('show'); document.removeEventListener('click', closeAccountDropdown);} }

    function getUserIdentifier(){ const userId=localStorage.getItem('user_id'); let sessionId=localStorage.getItem('session_id'); if(!sessionId){ sessionId='guest_'+Date.now(); localStorage.setItem('session_id', sessionId);} return { userId, sessionId }; }
    async function fetchCartCount(){ const { userId, sessionId } = getUserIdentifier(); const p=new URLSearchParams(); if(userId) p.append('user_id', userId); if(sessionId) p.append('session_id', sessionId); try{ const res=await fetch(`api/public/index.php?route=carts&${p}`); const data=await res.json(); if(data.error) return 0; const items=data.data||[]; return items.reduce((s,i)=>s+parseInt(i.quantity||0),0);}catch(e){ return 0; } }
    async function updateCartCount(){ const count=await fetchCartCount(); const span=document.querySelector('.Card-icon span'); if(span) span.textContent=count; }

    async function loadCartModal(){ const { userId, sessionId }=getUserIdentifier(); const p=new URLSearchParams(); if(userId) p.append('user_id', userId); if(sessionId) p.append('session_id', sessionId); try{ const res=await fetch(`api/public/index.php?route=carts&${p}`); const data=await res.json(); if(data.error) return; const items=data.data||[]; populateCartModal(items);}catch(e){} }
    function populateCartModal(items){ const s=document.getElementById('dynamic-product-summary'); if(items.length===0){ s.innerHTML='<p>Your shopping bag is empty.</p>'; return;} let total=0; const html=items.map(item=>{ const itemTotal=parseFloat(item.price)*item.quantity; total+=itemTotal; return `\n          <div class="cart-item">\n            <img src="uploads/${item.image || item.product_image || 'card1.jpg'}" alt="${item.product_name || 'Produit'}" class="product-img">\n            <div class="product-info">\n              <h4>${item.product_name || 'Nom non disponible'}</h4>\n              <p class="price">${item.price ? item.price + '$' : 'Prix non disponible'}</p>\n              <p class="quantity">Quantity: ${item.quantity}</p>\n            </div>\n          </div>\n        `; }).join(''); s.innerHTML = `\n        <div class="cart-items-list" style="max-height: 300px; overflow-y: auto;">\n          ${html}\n        </div>\n        <div class="cart-total">\n          <p>Total: $${total.toFixed(2)}</p>\n        </div>\n      `; }

    const cartModal=document.getElementById('cartModal');
    const modalContent=cartModal.querySelector('.modal-content');
    const closeModal=document.getElementById('closeModal');
    function openModalAnchored(e){ if(e) e.preventDefault(); const anchor=document.querySelector('.Card-icon'); if(!anchor) return; const rect=anchor.getBoundingClientRect(); cartModal.style.display='flex'; cartModal.style.background='transparent'; modalContent.style.position='fixed'; modalContent.style.transform='none'; modalContent.style.maxWidth='320px'; modalContent.style.visibility='hidden'; requestAnimationFrame(()=>{ const mW=modalContent.offsetWidth||320; const leftOffset=50; let left=rect.left + rect.width/2 - mW/2 - leftOffset; left=Math.max(8, Math.min(left, window.innerWidth - mW - 8)); const top=rect.bottom + 8; modalContent.style.left=`${left}px`; modalContent.style.top=`${top}px`; modalContent.style.visibility='visible'; modalContent.style.zIndex='4001'; }); }
    function closeModalAnchored(){ cartModal.style.display='none'; modalContent.style.position=''; modalContent.style.left=''; modalContent.style.top=''; modalContent.style.transform=''; modalContent.style.maxWidth=''; modalContent.style.visibility=''; modalContent.style.zIndex=''; cartModal.style.background='rgba(0,0,0,0.25)'; }

    function updateAccountMenu(){ const menu=document.querySelector('.account-menu'); const user=localStorage.getItem('user'); if(user){ menu.innerHTML=`\n          <a href="myaccount.html">My Account</a>\n          <a href="#" onclick="event.preventDefault();">My Orders</a>\n          <a href="accountsetting.php">Account Settings</a>\n          <a href="#" onclick="event.preventDefault();">Address Book</a>\n          <a href="#" onclick="event.preventDefault();">Saved Items</a>\n          <a href="#" onclick="logout(event)">Logout</a>\n        `; } else { menu.innerHTML=`\n          <a href="sign.php">Sign In</a>\n        `; } }
    function logout(e){ e.preventDefault(); localStorage.removeItem('user'); window.location.href='index.php'; }

    // Share modal logic
    const shareModal=document.getElementById('shareModal');
    const closeShareBtn=document.getElementById('closeShareModal');
    const shareTitleEl=document.getElementById('shareProductTitle');
    const shareUrlInput=document.getElementById('shareUrlInput');
    const shareFacebook=document.getElementById('shareFacebook');
    const shareTwitter=document.getElementById('shareTwitter');
    const sharePinterest=document.getElementById('sharePinterest');
    function openShareModal(title, url){
      shareTitleEl.textContent=title;
      const link=url||window.location.href;
      shareUrlInput.value=link;
      shareFacebook.onclick=()=>{ window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(link)}`,'_blank'); };
      shareTwitter.onclick=()=>{ const text=encodeURIComponent(title); window.open(`https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(link)}`,'_blank'); };
      sharePinterest.onclick=()=>{ window.open(`https://pinterest.com/pin/create/button/?url=${encodeURIComponent(link)}&description=${encodeURIComponent(title)}`,'_blank'); };
      shareModal.style.display='flex';
      document.body.classList.add('modal-open');
    }
    function closeShareModal(){ shareModal.style.display='none'; }

    document.addEventListener('DOMContentLoaded', function(){
      updateAccountMenu();
      updateCartCount();
      const closeBtn=document.getElementById('closeModal'); if(closeBtn){ closeBtn.addEventListener('click', closeModalAnchored); }
      const modal=document.getElementById('cartModal'); if(modal){ modal.addEventListener('click', function(e){ if(e.target===modal){ closeModalAnchored(); } }); }
      const icon=document.querySelector('.Card-icon'); if(icon){ icon.addEventListener('click', async function(e){ e.preventDefault(); await loadCartModal(); openModalAnchored(e); }); }
      const iconLink=document.querySelector('.cart-container a'); if(iconLink){ iconLink.addEventListener('click', async function(e){ e.preventDefault(); await loadCartModal(); openModalAnchored(e); }); }
      const shareButtons=document.querySelectorAll('.btn-share');
      shareButtons.forEach(btn=>{ btn.addEventListener('click', function(e){ e.preventDefault(); const card=this.closest('.card'); const title=card?card.querySelector('h4')?.textContent?.trim():'Item'; const url=window.location.href; openShareModal(title||'Item', url); }); });
      if(closeShareBtn){ closeShareBtn.addEventListener('click', closeShareModal); }
      if(shareModal){ shareModal.addEventListener('click', function(e){ if(e.target===shareModal){ closeShareModal(); } }); }
      const copyBtn=document.getElementById('copyShareUrl'); if(copyBtn){ copyBtn.addEventListener('click', async function(){ try{ await navigator.clipboard.writeText(shareUrlInput.value); this.textContent='Copied'; setTimeout(()=>this.textContent='Copy',1200); }catch(_e){ shareUrlInput.select(); document.execCommand('copy'); this.textContent='Copied'; setTimeout(()=>this.textContent='Copy',1200); } }); }
    });
  </script>

</body>
</html>


