<?php include 'loader.php'; ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Honicove — Shop</title>

  <!-- PT Futura Condensed depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=PT+Futura+Condensed:wght@400&display=swap" rel="stylesheet">

  <!-- Red Hat Display Medium depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@500&display=swap" rel="stylesheet">

  <!-- Dancing Script depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

  <!-- Grey Qo depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Grey+Qo:wght@400&display=swap" rel="stylesheet">

  <!-- External CSS -->
  <link rel="stylesheet" href="style.css">
  
  
<head>
<style>
  .modal-overlay-index {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  /* background: rgba(11, 23, 36, 0.7); */
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 2000;
}

.modal-content-index {
  background: transparent;
  border-radius: 16px;
  padding: 0;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(11, 23, 36, 0.2);
  max-width: 820px;
  width: 90%;
  position: relative;
  display: flex;
  gap: 0;
  align-items: stretch;
}

.modal-left-index {
  flex: 1;
  background: #7A0B1A;
  color: #FAF6F0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 32px;
  gap: 16px;
}

.thank-you-text {
  font-size: 40px;
  color: #FAF6F0;
  text-transform: lowercase;
  font-family: "Parisienne", cursive;
  font-weight: 700;
  font-style: normal;
  letter-spacing: 2px;
}

.modal-logo-below {
  width: 100px;
  height: auto;
}

.modal-image-index {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

.modal-right-index {
  flex: 1;
  background: #FAF6F0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 32px;
  text-align: center;
}

.modal-h-index {
  width: 25%;
  height: auto;
  margin: 0 0 16px 0;
}

.modal-message-index {
   font-family: "Caveat", cursive;
   font-optical-sizing: auto;
   font-weight: 400;
   font-style: normal;
   font-size: 20px;
   color: var(--midnight);
   margin-bottom: 24px;
   /* font-weight: bold; */
   text-transform: lowercase;
   letter-spacing: 1px;
   min-height: 24px;
}

.subscribe-form-index {
  display: flex;
  flex-direction: column;
  gap: 12px;
  align-items: center;
  
}

.email-input-index {
  padding: 12px 16px;
  border: 1px solid rgba(11, 23, 36, 0.2);
  border-radius: 8px;
  font-size: 16px;
  width: 100%;
  max-width: 250px;
  font-family: "Red Hat Display", sans-serif;
}

.subscribe-btn-index {
  padding: 12px 24px;
  background: var(--maroon);
  color: var(--white);
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  text-transform: lowercase;
  transition: background 0.3s ease;
  font-family: "Red Hat Display", sans-serif;
}

.subscribe-btn-index:hover {
  background: var(--cherry);
}

.modal-close-index {
  position: absolute;
  top: 16px;
  right: 16px;
  background: none;
  border: none;
  font-size: 24px;
  color: var(--muted);
  cursor: pointer;
  transition: color 0.3s ease;
}

.modal-close-index:hover {
  color: var(--maroon);
}

/* Responsive modal */
@media (max-width: 640px) {
  .modal-content-index {
    flex-direction: column;
  }

  .modal-left-index, .modal-right-index {
    flex: none;
    padding: 24px;
  }

  .modal-image-index {
    max-width: 200px;
  }
}

</style>
<body>

  <div class="top-bar">
    <div class="contenair">
    <h4>
      Free Domestic and International Shipping
    </h4>
    </div>
  </div>

  <header class="site-header">
    
    <nav class="brand" aria-label="Brand">
     <a href="#" onclick="toggleSideMenu(event)" aria-label="Shop">shop</a>
     <a href="blog.php" aria-label="Our Story">blog</a>

     <a href="about.php" aria-label="About">about</a>

    </nav>

    <!-- Side Menu Backdrop -->
    <div id="side-menu-backdrop" class="side-menu-backdrop" onclick="closeSideMenu()"></div>

    <!-- Side Menu Overlay -->
    <div id="side-menu" class="side-menu">
      <button class="close-menu" onclick="closeSideMenu()">&times;</button>
      <h3>shop</h3>
      <a href="#" onclick="scrollToSection('shop', event)">new arrivals</a>
      <a href="#" onclick="scrollToSection('shop', event)">clothing</a>
      <a href="#" onclick="scrollToSection('shop', event)">mats</a>
      <a href="#" onclick="scrollToSection('shop', event)">weights</a>
      <a href="#" onclick="scrollToSection('shop', event)">accessories</a>
    </div>
    
    <div class="logo-primary" id="header-logo">
      <a href="index.php"><img src="logo/Secondary Mark, white.png" alt="Honicove Logo" class="logo-mark"></a>
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
            <a href="accountsetting.html">Account Settings</a>
            <a href="#" onclick="event.preventDefault();">Address Book</a>
            <a href="#" onclick="event.preventDefault();">Saved Items</a>
          </ul>
        </div>
      </div>
      <div class="cart-container">
        <a href="#" onclick="openModalAnchored(event)" aria-label="Cart"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></a>
        <button class="Card-icon" onclick="openModalAnchored(event)" aria-label="Voir le panier">
          <span>2</span>
        </button>
      </div>
    </nav>
  </header>

  <main class="wrap">
    <!-- HERO -->
    <section class="hero" id="hero">
      <div class="hero-text">
        <h1>
          Designed for 
        </h1>
        <h1>
          Everyday comfort
        </h1>
        <a href="#" class="hero-link">
           New arrivals
        </a>
      </div>
      <div class="logo-primary" id="hero-logo">
        <img src="logo/Primary, White.png" alt="Honicove Logo">
      </div>
    </section>

    <!-- PRODUCT GRID -->
    <section id="shop">
     <div class="shop-text">
        <h1>
          Designed for 
        </h1>
        <h1>
          Everyday comfort
        </h1>
      </div>
      <div class="shop-buttons">
        <button>Best Sellers</button>
        <button>Sets</button>
        <button>Accessories</button>
      </div>
      <div class="grid" id="product-grid">
        
      </div>
    </section>

   
  </main>

  <!-- Welcome odal -->
  <div id="welcome-modal-overlay" class="modal-overlay-index">
    <div class="modal-content-index">
    <div class="modal-left-index">
        <div class="thank-you-text">thank you</div>
        <img src="logo/Primary, White.png" alt="Honicove Logo" class="modal-logo-below">
      </div>
      <div class="modal-right-index">
        <img src="logo/Secondary Mark, Red.png" alt="Honicove Logo" class="modal-h-index">
        <div id="modal-message" class="modal-message-index"></div>
        <form class="subscribe-form-index">
          <input type="email" placeholder="Enter your email" class="email-input-index" required>
          <button type="submit" class="subscribe-btn-index">Subscribe</button>
        </form>
      </div>
      <button id="modal-close" class="modal-close-index">&times;</button>
    </div>
  </div>

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
          <a href="blog.html">Our Story</a>
          <a href="about.html">About Us</a>
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


  <!-- Product Fetching and Grid Generation -->
  <script>
    // Function to fetch all products from API
    async function fetchProducts() {
      try {
        const response = await fetch('api/public/index.php?route=/products');
        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des produits');
        }
        const data = await response.json();
        return data.data; // Assuming the API returns { data: [...] }
      } catch (error) {
        console.error('Erreur:', error);
        return [];
      }
    }

    // Function to generate product cards HTML
    function generateProductCards(products) {
      return products.map(product => {
        // Utiliser la nouvelle structure images si disponible, sinon l'ancienne
        const imageSrc = (product.images && product.images.length > 0) ? `uploads/${product.images[0].image_path}` : (product.image_1 ? `uploads/${product.image_1}` : 'uploads/card1.jpg');
        // Construire les attributs data-image dynamiquement
        let dataAttrs = '';
        if (product.images && product.images.length > 0) {
          product.images.forEach((img, idx) => {
            dataAttrs += ` data-image${idx + 1}="${img.image_path}"`;
          });
        } else {
          dataAttrs = ` data-image1="${product.image_1 || ''}" data-image2="${product.image_2 || ''}" data-image3="${product.image_3 || ''}"`;
        }
        // Utiliser la nouvelle structure couleurs si disponible, sinon l'ancienne
        const colorString = (product.images && product.images.length > 0) ? product.images.map(img => img.color).filter(c => c && c.trim() !== '').join(',') : (product.color || '');
        return `
          <div class="card" data-id="${product.id}" data-color="${colorString}"${dataAttrs}>
            <div class="card-top">
              <button class="card-fav" aria-label="Ajouter aux favoris">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20.8 4.6c-1.5-1.6-4-1.6-5.6 0L12 7.8 8.8 4.6c-1.6-1.6-4.1-1.6-5.6 0-1.6 1.6-1.6 4.2 0 5.8l8.8 8.9 8.8-8.9c1.6-1.6 1.6-4.2 0-5.8z"/>
                </svg>
              </button>
            </div>
            <a href="produit.php?id=${product.id}">
              <img src="${imageSrc}" alt="${product.name || 'Produit'}">
              <h4>${product.name || 'Nom non disponible'}</h4>
              <p class="subtitle">${product.description || 'Description non disponible'}</p>
              <p class="price">$${product.price || 'Prix non disponible'}</p>
              <div class="color-swatches"></div>
            </a>
          </div>
        `;
      }).join('');
    }

    // Populate product grid on page load
    document.addEventListener('DOMContentLoaded', async () => {
      const productGrid = document.getElementById('product-grid');
      const products = await fetchProducts();
      const cardsHtml = generateProductCards(products);
      productGrid.innerHTML = cardsHtml;

      // Populate color swatches for each card
      products.forEach(product => {
        const card = document.querySelector(`.card[data-id="${product.id}"]`);
        if (card) {
          const colorSwatches = card.querySelector('.color-swatches');
          // Utiliser les couleurs depuis product.images si disponible, sinon l'ancienne méthode
          let colors = [];
          if (product.images && product.images.length > 0) {
            colors = product.images.map(img => img.color).filter(c => c && c.trim() !== '');
          } else {
            const colorString = product.color;
            if (colorString && colorString.trim() !== '') {
              colors = colorString.split(/\s*,\s*|\s+/).map(c => c.trim().toLowerCase()).filter(c => c);
            }
          }
          if (colors.length > 0) {
            const colorMap = {
              'blanc': 'white',
              'noir': 'black',
              'rouge': 'red',
              'bleu marine': 'navy',
              'white': 'white',
              'black': 'black',
              'red': 'red',
              'navy': 'navy',
              'gray': 'gray',
              'lightgray': 'lightgray',
              'darkgray': 'darkgray',
              'darkred': 'darkred',
              'darkblue': 'darkblue',
              'darkgreen': 'darkgreen',
              'yellow': 'yellow',
              'orange': 'orange',
              'purple': 'purple',
              'pink': 'pink',
              'brown': 'brown',
              'teal': 'teal',
              'cyan': 'cyan',
              'indigo': 'indigo',
              'lime': 'lime',
              'gold': 'gold',
              'silver': 'silver',
              'beige': 'beige',
              'cream': 'cream',
              'black-50': 'black-50',
              'white-50': 'white-50',
              'red-50': 'red-50',
              'blue-50': 'blue-50',
              'green-50': 'green-50'
            };
            colors.forEach((color, index) => {
              const button = document.createElement('button');
              button.className = 'color';
              button.style.backgroundColor = color.startsWith('#') ? color : (colorMap[color] ? colorMap[color] : color);
              button.setAttribute('data-color', color);
              button.setAttribute('data-index', index);
              button.addEventListener('click', (e) => {
                e.preventDefault();
                const card = e.target.closest('.card');
                const img = card.querySelector('img');
                const imageAttr = `data-image${index + 1}`;
                const newImage = card.getAttribute(imageAttr);
                if (newImage) {
                  img.src = `uploads/${newImage}`;
                }
              });
              colorSwatches.appendChild(button);
            });
          } else {
            colorSwatches.innerHTML = '<span class="color">Couleur non disponible</span>';
          }
        }
      });
    });
  </script>

  <!-- Minimal JS for navigation -->
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

    // Fonction de recherche
    function handleSearch() {
      const searchTerm = document.querySelector('.search-bar input').value.toLowerCase();
      const cards = document.querySelectorAll('.card');

      cards.forEach(card => {
        const productName = card.querySelector('h4').textContent.toLowerCase();
        if (productName.includes(searchTerm)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // Ajouter l'événement de recherche
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.querySelector('.search-bar input');
      if (searchInput) {
        searchInput.addEventListener('keyup', handleSearch);
      }
    });
  </script>
  <script>
  window.addEventListener('scroll', function() {
    const bar = document.querySelector('.top-bar');
    if (window.scrollY > 10) {
      bar.classList.add('sticky');
    } else {
      bar.classList.remove('sticky');
    }
  });
</script>
<script>
  window.addEventListener("scroll", () => {
    const header = document.querySelector("header.site-header");
    const heroLogo = document.getElementById("hero-logo");

    if (window.scrollY > window.innerHeight * 0.3) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
</script>
<script>
  window.addEventListener("scroll", () => {
    const body = document.body;
    const header = document.querySelector("header.site-header");
    const scrollY = window.scrollY;
    const triggerStart = 0; // Début du mouvement dès le premier pixel de scroll
    const triggerEnd = 0;   // Animation immédiate sans attendre

    if (scrollY > triggerStart) {
      body.classList.add("scrolled-start");
    } else {
      body.classList.remove("scrolled-start");
    }

    if (scrollY > triggerEnd) {
      body.classList.add("scrolled-past");
      header.classList.add("scrolled");
    } else {
      body.classList.remove("scrolled-past");
      header.classList.remove("scrolled");
    }
  });
</script>


  <!-- Promo Pop-up -->
  <div id="promo-popup" class="promo-popup">
    <div class="promo-content">
      <span>Use code <strong>HONI10</strong> for 10% off your first purchase!</span>
      <button id="promo-close">&times;</button>
    </div>
  </div>

  <!-- Welcome Modal JS -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalOverlay = document.getElementById('welcome-modal-overlay');
    const modalMessage = document.getElementById('modal-message');
    const closeBtn = document.getElementById('modal-close');
    const message = "Hey honi, welcome to the cove";
    let index = 0;

    // Function to show modal and start typing
    function showModal() {
      modalOverlay.style.display = 'flex';
      modalMessage.textContent = '';
      index = 0;
      typeWriter();
    }

    // Typing animation function
    function typeWriter() {
      if (index < message.length) {
        modalMessage.textContent += message.charAt(index);
        index++;
        setTimeout(typeWriter, 100); // 100ms delay per character
      }
    }

    // Close modal function
    function closeModal() {
      modalOverlay.style.display = 'none';
    }

    // Event listeners
    closeBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', function(e) {
      if (e.target === modalOverlay) {
        closeModal();
      }
    });

    // Show modal 2 seconds after page load
    setTimeout(showModal, 3000);
  });
</script>

<!-- Promo Pop-up JS -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const promoPopup = document.getElementById('promo-popup');
    const promoClose = document.getElementById('promo-close');

    // Show promo popup after 2 seconds
    setTimeout(() => {
      promoPopup.style.display = 'block';
    }, 2000);
    promoClose.addEventListener('click', () => {
      promoPopup.style.display = 'none';
    });
  });
</script>

<!-- Cart Modal
<div id="cart-modal" class="cart-modal">
  <div class="cart-modal-content">
    <div class="cart-modal-header">
      <h2>Your Cart</h2>
      <button id="close-cart-modal" class="close-cart-modal">&times;</button>
    </div>
    <div class="cart-modal-body">
      <div id="cart-items"></div>
      <div class="cart-total">
        <p>Total: $<span id="cart-total-price">0.00</span></p>
      </div>
    </div>
    <div class="cart-modal-footer">
      <button id="checkout-btn" class="checkout-btn">Checkout</button>
    </div>
  </div>
</div> -->

<!-- Cart Modal JS -->
<script>
  function openModalAnchored(e) {
    e.preventDefault();
    const modal = document.getElementById('cart-modal');
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeModalAnchored() {
    const modal = document.getElementById('cart-modal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
  }

  document.addEventListener('DOMContentLoaded', function() {
    const closeBtn = document.getElementById('close-cart-modal');
    const checkoutBtn = document.getElementById('checkout-btn');
    const modal = document.getElementById('cart-modal');

    closeBtn.addEventListener('click', closeModalAnchored);
    checkoutBtn.addEventListener('click', function() {
      window.location.href = 'shopping-bag.php';
    });

    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModalAnchored();
      }
    });
  });
</script>

</body>
</html>
<!-- final -->