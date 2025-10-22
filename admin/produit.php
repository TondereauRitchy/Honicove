
<?php
session_start();

if (empty($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Produits</title>
  <link rel="stylesheet" href="admin.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
  <script src="sweetalert2.min.js"></script>
  <script>
    function openPopup(e) {
      e.preventDefault();
      document.querySelector(".overlay-popup").classList.add("active-popup");
    }
  </script>
</head>
<body>
  <?php require('includes/menu.php'); ?>

  <div class="contenaire">
    <div class="header">
      <div class="nav">
        <a href="#" onclick="openPopup(event)" class="btn">Add new</a>
      </div>

      <div class="overlay-popup">
        <div class="content-popup">
          <form class="form-produit" enctype="multipart/form-data">
            <input type="hidden" id="produit_id" name="id" />
            <input type="hidden" name="category_id" value="1" />
            <input type="text" id="nom_produit" name="name" placeholder="Nom du produit" required />
            <div id="images-colors-container">
              <div class="image-color-pair">
                <label for="image1">Choisissez une image :</label>
                <input type="file" name="images[]" id="image1" accept="image/*">
                <label for="couleur_picker1">Choisissez une couleur :</label>
                <input type="color" name="colors[]" id="couleur_picker1">
              </div>
              <div class="image-color-pair">
                <label for="image2">Choisissez une image 2 :</label>
                <input type="file" name="images[]" id="image2" accept="image/*">
                <label for="couleur_picker2">Choisissez une couleur :</label>
                <input type="color" name="colors[]" id="couleur_picker2">
              </div>
              <div class="image-color-pair">
                <label for="image3">Choisissez une image 3 :</label>
                <input type="file" name="images[]" id="image3" accept="image/*">
                <label for="couleur_picker3">Choisissez une couleur :</label>
                <input type="color" name="colors[]" id="couleur_picker3">
              </div>
            </div>
            <button type="button" id="add-more-btn">Ajouter plus d'images et couleurs</button>
            <textarea id="description" name="description" placeholder="Description" required></textarea>
            <input type="text" id="subtitle" name="subtitle" placeholder="Sous-titre" />
            <input type="number" id="quantite" name="quantity" placeholder="Quantité" min="1" required />
            <input type="number" id="prix" name="price" placeholder="Prix (gds)" step="0.01" min="0" required />
            <input type="text" id="size" name="size" placeholder="Size" />
            <input type="text" id="couleur" name="color" placeholder="Couleur" />
            <button type="submit" id="btn-submit" data-mode="ajouter">Ajouter</button>
          </form>
          <button class="close">X</button>
        </div>
      </div>
    </div>

    <table id="produits-table" class="display">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Image1</th>
          <th>Image2</th>
          <th>Image3</th>
          <th>Description</th>
          <th>Subtitle</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>Size</th>
          <th>Couleur</th>
          <th>Date d’ajout</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <script>
    function openPopup(e) {
      e.preventDefault();
      document.querySelector(".overlay-popup").classList.add("active-popup");
    }

    document.querySelector(".close").addEventListener("click", () => {
      document.querySelector(".overlay-popup").classList.remove("active-popup");
      document.querySelector('.form-produit').reset();
      document.getElementById('btn-submit').textContent = "Ajouter";
      document.getElementById('btn-submit').setAttribute("data-mode", "ajouter");
      // Reset dynamic fields
      const container = document.getElementById('images-colors-container');
      const pairs = container.querySelectorAll('.image-color-pair');
      for (let i = 3; i < pairs.length; i++) {
        pairs[i].remove();
      }
    });

    async function chargerProduits() {
      try {
        const res = await fetch('../api/products');
        const result = await res.json();
        const tbody = document.querySelector('#produits-table tbody');
        tbody.innerHTML = '';


        if (result.data && Array.isArray(result.data)) {
          result.data.forEach(p => {
            const row = document.createElement('tr');
            const imageName = p.image_1;
            const image2Name = p.image_2;
            const image3Name = p.image_3;


            row.innerHTML = `
              <td>${p.name}</td>
              <td><img src="../uploads/${imageName}" style="width:60px; height:auto; border-radius:6px;"></td>
              <td><img src="../uploads/${image2Name}" style="width:60px; height:auto; border-radius:6px;"></td>
              <td><img src="../uploads/${image3Name}" style="width:60px; height:auto; border-radius:6px;"></td>
              <td>${p.description}</td>
              <td>${p.subtitle || ''}</td>
              <td>${p.price} gds</td>
              <td>${p.quantity}</td>
              <td>${p.size}</td>
              <td>${p.color}</td>
              <td>${p.created_at}</td>
              <td>
                <button class="btn-edit" data-produit='${JSON.stringify(p).replace(/'/g, "&apos;")}' title="Modifier">✏️</button>
                <button onclick="supprimerProduit('${p.id}')" class="btn-delete" title="Supprimer">🗑</button>
              </td>
            `;
            tbody.appendChild(row);
          });
        }

      } catch (err) {
        console.error('Erreur chargement produits :', err);
      }
    }

    document.addEventListener("click", function(e) {
      if (e.target.classList.contains("btn-edit")) {
        const data = e.target.getAttribute("data-produit").replace(/&apos;/g, "'");
        const produit = JSON.parse(data);
        modifierProduit(produit);
      }
    });

    document.querySelector('.form-produit').addEventListener('submit', async function (e) {
      e.preventDefault();

      const mode = document.getElementById('btn-submit').getAttribute('data-mode');
      const form = e.target;
      const formData = new FormData(form);

      let endpoint = 'controller/save_product.php';

      try {
        const res = await fetch(endpoint, {
          method: 'POST',
          body: formData
        });
        const result = await res.json();

        if (!result.error) {
          Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: result.message || "Produit traité avec succès"
          }).then(() => {
            form.reset();
            document.querySelector('.overlay-popup').classList.remove("active-popup");
            chargerProduits();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: result.message || "Une erreur est survenue."
          });
        }
      } catch (err) {
        console.error("Erreur d’envoi :", err);
        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: "Erreur lors de l’envoi du produit."
        });
      }
    });

    async function supprimerProduit(id) {
      const confirmation = await Swal.fire({
        title: 'Confirmer la suppression',
        text: "Voulez-vous vraiment supprimer ce produit ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer'
      });

      if (!confirmation.isConfirmed) return;

      try {
        const res = await fetch('../api/products/' + id, {
          method: 'DELETE',
          headers: { 'Content-Type': 'application/json' }
        });
        const result = await res.json();

        if (!result.error) {
          Swal.fire({
            icon: 'success',
            title: 'Supprimé',
            text: 'Produit supprimé avec succès.'
          });
          chargerProduits();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: result.message || "Impossible de supprimer le produit."
          });
        }
      } catch (err) {
        console.error('Erreur suppression :', err);
      }
    }


function modifierProduit(p) {
      document.getElementById('produit_id').value = p.id;
      document.getElementById('nom_produit').value = p.name;
      document.getElementById('description').value = p.description;
      document.getElementById('subtitle').value = p.subtitle || '';
      document.getElementById('quantite').value = p.quantity;
      document.getElementById('prix').value = p.price;
      document.getElementById('size').value = p.size;
      document.getElementById('couleur').value = p.color;

      document.querySelector(".overlay-popup").classList.add("active-popup");
      document.getElementById('btn-submit').textContent = "Mettre à jour";
      document.getElementById('btn-submit').setAttribute("data-mode", "modifier");
    }

    // Add more images and colors functionality
    let pairCounter = 4; // Start from 4 since we have 1,2,3

    document.getElementById('add-more-btn').addEventListener('click', function() {
      const container = document.getElementById('images-colors-container');
      const newPair = document.createElement('div');
      newPair.className = 'image-color-pair';
      newPair.innerHTML = `
        <label for="image${pairCounter}">Choisissez une image ${pairCounter} :</label>
        <input type="file" name="images[]" id="image${pairCounter}" accept="image/*">
        <label for="couleur_picker${pairCounter}">Choisissez une couleur :</label>
        <input type="color" name="colors[]" id="couleur_picker${pairCounter}">
      `;
      container.appendChild(newPair);
      pairCounter++;
    });

    $(document).ready(function () {
      $('#produits-table').DataTable();
      chargerProduits();
    });
  </script>
</body>
</html>