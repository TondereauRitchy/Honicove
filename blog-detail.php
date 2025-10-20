<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Honicove — Blog Detail</title>

  <!-- PT Futura Condensed depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=PT+Futura+Condensed:wght@400&display=swap" rel="stylesheet">

  <!-- Red Hat Display Bold depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@700&display=swap" rel="stylesheet">

  <!-- Dancing Script depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

  <!-- Cormorant Garamond depuis Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- External CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body class="blog-page">

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
      <h3>Shop</h3>
       <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">new arrivals</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">clothing</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">best sellers</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">sets</a>
        <a href="#" class="shop-link" onclick="scrollToSection('shop', event)">accessories</a>
      </div>

      <div class="logo-primary" id="header-logo2">
        <img src="logo/Secondary Mark, Black.png" alt="Honicove Logo" class="logo-mark">
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
              <a href="#" onclick="event.preventDefault();">Sign In</a>
              <a href="#" onclick="event.preventDefault();">My Orders</a>
              <a href="#" onclick="event.preventDefault();">Account Settings</a>
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
     <!-- BLOG HEADER -->
    <section class="blog-header">
      <h1>Welcome to the cove</h1>
    </section>

    <!-- BLOG DETAIL -->
    <section class="blog-detail">
      <article class="blog-article">
        <h1>Welcome to mindful mornings</h1>
        <div class="blog-meta">
          <span class="date">October 15, 2023</span>
          <span class="author">By Honicove Team</span>
        </div>
        <img src="logo/image1.jpg" alt="Mindful Mornings" class="blog-image">
        <div class="blog-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <h2>Subheading One</h2>
          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <h2>Subheading Two</h2>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
          <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
        </div>
        <div class="image-blog">
          <img src="logo/blog.jpg" alt="Blog Image">
          <img src="logo/blog.jpg" alt="Blog Image">
          <img src="logo/blog.jpg" alt="Blog Image">
          <img src="logo/blog.jpg" alt="Blog Image">
        </div>
         <div class="blog-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatSed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatSed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatSed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatSed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
        <!-- <a href="blog.php" class="back-to-blog">Retour au blog</a>p -->
        <div class="related-posts">
          <h3>Articles similaires</h3>
          <div class="related-grid">
            <div class="related-card">
              <img src="logo/image2.jpg" alt="Sustainable Fashion">
              <h4>Sustainable Fashion Tips</h4>
              <a href="blog-detail.html?id=2">Lire plus</a>
            </div>
            <div class="related-card">
              <img src="logo/mainImage (1).jpg" alt="Fitness Journey">
              <h4>Your Fitness Journey</h4>
              <a href="blog-detail.php?id=3">Lire plus</a>
            </div>
          </div>
        </div>
      </article>
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

  <!-- Modal Panier -->
  <div id="cartModal" class="modal">
    <div class="modal-content">
      <button class="close-btn" id="closeModal">&times;</button>

      <div class="product-summary">
        <img src="logo/card1.jpg" alt="Product" class="product-img">
        <div class="product-info">
          <h4>GUCCI BEATRIX LARGE TOTE BAG</h4>
          <p class="price">$3,300</p>
          <p class="style">Style: 850546 AAF0J 2118</p>
          <p class="quantity">Quantity: 2</p>
        </div>
      </div>

      <div class="modal-actions">
        <button class="btn black">CHECKOUT</button>
        <a class="btn white" href="shopping-bag.php">VIEW SHOPPING BAG</a>
      </div>
    </div>
  </div>

  <!-- Minimal JS for navigation -->
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

    function openModalAnchored(e) {
      e.preventDefault();
      const modal = document.getElementById('cartModal');
      const modalContent = modal.querySelector('.modal-content');
      const cartIcon = e.target.closest('.cart-container').querySelector('.Card-icon');
      const rect = cartIcon.getBoundingClientRect();
      modal.style.display = 'block';
      modalContent.style.position = 'fixed';
      modalContent.style.top = (rect.bottom + 10) + 'px';
      modalContent.style.left = (rect.left - 200) + 'px';
      modalContent.style.transform = 'none';
    }

    function closeModalAnchored() {
      const modal = document.getElementById('cartModal');
      const modalContent = modal.querySelector('.modal-content');
      modal.style.display = 'none';
      modalContent.style.position = 'absolute';
      modalContent.style.top = '';
      modalContent.style.left = '';
      modalContent.style.transform = '';
    }

    // Cart modal close functionality
    document.addEventListener('DOMContentLoaded', function() {
      const closeBtn = document.getElementById('closeModal');
      if (closeBtn) {
        closeBtn.addEventListener('click', closeModalAnchored);
      }

      const modal = document.getElementById('cartModal');
      if (modal) {
        modal.addEventListener('click', function(e) {
          if (e.target === modal) {
            closeModalAnchored();
          }
        });
      }
    });
  </script>

</body>
</html>
