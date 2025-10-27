<!-- Loader fragment (à inclure au début du body) -->
<link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
<style>
  /* Styles du loader, encapsulés pour éviter les effets de bord */
  .honi-loader__lock-scroll { overflow: hidden !important; }
  .honi-loader__wrapper {
    position: fixed;
    inset: 0;
    background-color: #7A0B1A;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }
  .honi-preloader {
    display: flex;
    gap: 0;
    font-size: 80px;
    color: #7A0B1A;
    font-family: "Rancho", cursive;
  }
   .honi-preloader img {
    width: 50px;
    height: 50px;
    opacity: 0;
    transform: translateY(-100px);
    animation: honiDropIn 0.8s ease-out forwards;
    /* margin-left: -60px; 🔹 Optionnel : rapproche encore un peu les lettres visuellement */
  }

  .honi-preloader img:first-child {
    margin-left: 0; /* pas de décalage sur la première image */
  }
  @keyframes honiDropIn {
    0% { opacity: 0; transform: translateY(-100px); }
    100% { opacity: 1; transform: translateY(0); }
  }
  .honi-preloader img:nth-child(1) { animation-delay: 0.1s; }
  .honi-preloader img:nth-child(2) { animation-delay: 0.25s; }
  .honi-preloader img:nth-child(3) { animation-delay: 0.4s; }
  .honi-preloader img:nth-child(4) { animation-delay: 0.55s; margin-left: -15px; }
  .honi-preloader img:nth-child(5) { animation-delay: 0.7s; margin-left: -15px; }
  .honi-preloader img:nth-child(6) { animation-delay: 0.85s; }
  .honi-preloader img:nth-child(7) { animation-delay: 1s; }
  .honi-preloader img:nth-child(8) { animation-delay: 1.15s; }
  .honi-loader__fade-out { opacity: 0; transition: opacity 1s ease; pointer-events: none; }
</style>
<div id="honi-loader" class="honi-loader__wrapper">
  <div class="honi-preloader" aria-live="polite" aria-label="Chargement Honicove">
    <img src="honicove/blanc/un.png" alt="H">
    <img src="honicove/blanc/deux.png" alt="o">
    <img src="honicove/blanc/trois.png" alt="n">
    <img src="honicove/blanc/quatre (1).png" alt="i">
    <img src="honicove/blanc/cinq.png" alt="c">
    <img src="honicove/blanc/deux.png" alt="o">
    <img src="honicove/blanc/sept.png" alt="v">
    <img src="honicove/blanc/huit.png" alt="e">
  </div>
</div>
<script>
  (function(){
    // Verrouille le scroll pendant le chargement
    document.documentElement.classList.add('honi-loader__lock-scroll');
    document.body && document.body.classList.add('honi-loader__lock-scroll');

    function revealContent(){
      var loader = document.getElementById('honi-loader');
      if(!loader) return;
      loader.classList.add('honi-loader__fade-out');
      setTimeout(function(){
        loader.style.display = 'none';
        document.documentElement.classList.remove('honi-loader__lock-scroll');
        document.body && document.body.classList.remove('honi-loader__lock-scroll');
        var main = document.getElementById('main-content');
        if(main){ main.style.display = 'block'; }
      }, 1000);
    }

    // Dévoile après 2.5s ou quand le DOM est prêt, le plus tardif des deux
    var minDelayPassed = false;
    setTimeout(function(){ minDelayPassed = true; if(document.readyState === 'complete' || document.readyState === 'interactive'){ revealContent(); } }, 2500);
    if(document.readyState === 'loading'){
      document.addEventListener('DOMContentLoaded', function(){ if(minDelayPassed) revealContent(); });
    } else {
      if(minDelayPassed) revealContent();
    }
  })();
</script>
