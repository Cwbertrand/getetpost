<?php
    session_start();
    include "traitement.php";
?>

  <?php include './Includes/header.include.php' ?>

      <?php 

      //It passes a condition and the else part does a loop and shows the info of traitement.php
        if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo "<p>Aucune produit en session...</p>";
        }else{
            echo '<form method="get">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Produit</th>
                  <th scope="col">Prix Unitaire</th>
                  <th scope="col">Quantité</th>
                  <th scope="col">Total</th>
                  <th scope="col">Suprimer</th>
                </tr>
              </thead>
              <tbody>';
              $grosstotal = 0;
              foreach ($_SESSION['products'] as $index => $product) {
                echo '<tr>',
                        '<td>'.$index.'</td>',
                        '<td>'.$product['produit'].'</td>',
                        '<td>'.number_format($product['prix'], 2, ',', '&nbsp').' €</td>',
                        '<td> 
                            <form method="GET" class="">
                              <button type="button" name="minus" class="btn text-white bg-primary rounded-lg">
                                <i class="fa-solid fa-minus"></i>
                              </button>

                                '.$product['qty'].' 

                              <button type="button" name="plus" class="btn rounded-lg text-white bg-primary">
                                <i class="fa-solid fa-plus"></i>
                              </button>
                            </form>
                        </td>',
                        '<td>'.number_format($product['total'], 2, ',', '&nbsp').' €</td>', 
                        '<form method="get">
                          <td class="">
                              <a href=""><button type="submit" name="delete" class="btn bg-danger rounded-lg text-white text-center">
                                <i class="fa-solid fa-trash"></i>
                              </button></a>
                          </td>
                        </form>', 
                        //La fonction PHP number_format() permet de modifier l'affichage d'une valeur numérique 
                        //en précisant plusieurs paramètres
                      '</tr>';

                      //le fonction calcule tous le subtotal et donne le gross total
                      $grosstotal += $product['total']; 
              } 
              echo '<tr>
                        <td colspan=4 >Total General: </td>
                        <td><b>'.number_format($grosstotal, 2, ',', '&nbsp').' € </b></td>
                    </tr>
                    <tr>
                      <td>
                        <form method="get" action="index.php">
                          <a href="recap.php?action='. $_SESSION['all_delete'] .'"><button type="button" name="all_delete" class=" btn bg-danger rounded-lg text-white text-center">
                            Vider le panier
                          </button>
                        </form>
                      </td>
                    </tr>';
              '</tbody>
            </table>
            </form>';
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