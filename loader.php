<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Preloader Honicove</title>

  <!-- Police Rancho -->
  <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #fdf7f2;
      height: 100vh;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Rancho", cursive;
    }

    /* --- Conteneur du préloader --- */
    .preloader {
      display: flex;
      gap: 8px;
      font-size: 80px;
      color: #7A0B1A;
    }

    .preloader span {
      display: inline-block;
      opacity: 0;
      transform: translateY(-100px);
      animation: dropIn 0.8s ease-out forwards;
    }

    /* --- Animation de chute --- */
    @keyframes dropIn {
      0% {
        opacity: 0;
        transform: translateY(-100px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* --- Couleurs de chaque lettre --- */
    .preloader span:nth-child(1) { color: #7A0B1A; animation-delay: 0.1s; }
    .preloader span:nth-child(2) { color: #B24C63; animation-delay: 0.25s; }
    .preloader span:nth-child(3) { color: #E98074; animation-delay: 0.4s; }
    .preloader span:nth-child(4) { color: #EFC7C2; animation-delay: 0.55s; }
    .preloader span:nth-child(5) { color: #86A8E7; animation-delay: 0.7s; }
    .preloader span:nth-child(6) { color: #91EAE4; animation-delay: 0.85s; }
    .preloader span:nth-child(7) { color: #C9E265; animation-delay: 1s; }
    .preloader span:nth-child(8) { color: #FFB347; animation-delay: 1.15s; }

    /* --- Disparition du préloader --- */
    .fade-out {
      opacity: 0;
      transition: opacity 1s ease;
      pointer-events: none;
    }
  </style>
</head>
<body>

  <!-- Préloader -->
  <div class="preloader" id="preloader">
    <span>H</span>
    <span>o</span>
    <span>n</span>
    <span>i</span>
    <span>c</span>
    <span>o</span>
    <span>v</span>
    <span>e</span>
  </div>

  <!-- Ton contenu principal -->

  <script>
    // Une fois l'animation terminée, on cache le préloader
    setTimeout(() => {
      document.getElementById('preloader').classList.add('fade-out');
      setTimeout(() => {
        document.getElementById('preloader').style.display = 'none';
        document.getElementById('main-content').style.display = 'block';
      }, 1000);
    }, 2500);
  </script>

</body>
</html>
