<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}
$adminEmail = $_SESSION['email_admin'] ?? 'admin inconnu';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <title>ContactAdmin</title>
</head>
<body>
    <?php require('includes/menu.php'); ?>
    <div class="contenaire">
        
        
        <table id="contacts-table" class="display">
        <thead>
            <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            </tr>
        </thead>
        <tbody>
         
        </tbody>
        </table>

        <script>
fetch('../api/contacts')
  .then(response => response.json())
  .then(data => {
    console.log(data);
    
    const tbody = document.querySelector('#contacts-table tbody');
    tbody.innerHTML = ''; // Vide le tableau
    data.data.forEach(contact => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${contact.nom}</td>
        <td>${contact.email}</td>
        <td>${contact.message}</td>
      `;
      tbody.appendChild(row);
    });
  })
  .catch(error => {
    console.error('Erreur lors du chargement des contacts:', error);
  });
</script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#contacts-table').DataTable();
        });
        </script>
    </div>
</body>
</html> 