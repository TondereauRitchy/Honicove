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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <input type="text" id="nom_produit" name="nom" placeholder="Nom du produit" required />
            <label for="image">Choisissez une image :</label>
            <input type="file" name="image" id="image" accept="image/*">
            <textarea id="description" name="description" placeholder="Description" required></textarea>
            <input type="number" id="quantite" name="quantite" placeholder="Quantité" min="1" required />
            <input type="number" id="prix" name="prix" placeholder="Prix (gds)" step="0.01" min="0" required />
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
          <th>Image</th>
          <th>Description</th>
          <th>Prix</th>
          <th>Quantité</th>
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
    });

    async function chargerProduits() {
      try {
        const res = await fetch('../api/produits');
        const result = await res.json();
        const tbody = document.querySelector('#produits-table tbody');
        tbody.innerHTML = '';

        result.data.forEach(p => {
          const row = document.createElement('tr');
          const imageName = p.image_path.split('/').pop();

          row.innerHTML = `
            <td>${p.nom}</td>
            <td><img src="../uploads/${imageName}" style="width:60px; height:auto; border-radius:6px;"></td>
            <td>${p.description}</td>
            <td>${p.prix} gds</td>
            <td>${p.quantite}</td>
            <td>${p.date_ajout}</td>
            <td>
              <button class="btn-edit" data-produit='${JSON.stringify(p).replace(/'/g, "&apos;")}' title="Modifier">✏️</button>
              <button onclick="supprimerProduit('${p.id}')" class="btn-delete" title="Supprimer">🗑️</button>
            </td>
          `;
          tbody.appendChild(row);
        });
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
          });
          form.reset();
          document.querySelector('.overlay-popup').classList.remove("active-popup");
          chargerProduits();
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
        const res = await fetch('../api/produits/' + id, {
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
      document.getElementById('nom_produit').value = p.nom;
      document.getElementById('description').value = p.description;
      document.getElementById('quantite').value = p.quantite;
      document.getElementById('prix').value = p.prix;

      document.querySelector(".overlay-popup").classList.add("active-popup");
      document.getElementById('btn-submit').textContent = "Mettre à jour";
      document.getElementById('btn-submit').setAttribute("data-mode", "modifier");
    }

    $(document).ready(function () {
      $('#produits-table').DataTable();
      chargerProduits();
    });
  </script>
</body>
</html>
