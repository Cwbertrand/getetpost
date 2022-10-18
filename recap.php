<?php
    session_start();
    include "traitement.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="./CSS/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>


      <?php 

      //It passes a condition and the else part does a loop and shows the info of traitement.php
        if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo "<p>Aucune produit en session...</p>";
        }else{
            echo '<table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Produit</th>
                  <th scope="col">Prix Unitaire</th>
                  <th scope="col">Quantité</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>';
              $grosstotal = 0;
              foreach ($_SESSION['products'] as $index => $product) {
                echo '<tr>',
                        '<td>'.$index.'</td>',
                        '<td>'.$product['produit'].'</td>',
                        '<td>'.number_format($product['prix'], 2, ',', '&nbsp').' €</td>',
                        '<td>'.$product['qty'].'</td>',
                        '<td>'.number_format($product['total'], 2, ',', '&nbsp').' €</td>', 
                        //La fonction PHP number_format() permet de modifier l'affichage d'une valeur numérique 
                        //en précisant plusieurs paramètres
                      '</tr>';

                      //le fonction calcule tous le subtotal et donne le gross total
                      $grosstotal += $product['total']; 
              } 
              echo '<tr>
                        <td colspan=4 >Total General: </td>
                        <td><b>'.number_format($grosstotal, 2, ',', '&nbsp').' € </b></td>
                    </tr>';
              '</tbody>
            </table>';
        }
      
      ?>
      <div class="container py-5">
        <h2> Ajouter les Produit</h2>
    </div>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>