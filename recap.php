<?php
    session_start();
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
                            <a href="traitement.php?action=minus&qty='.$index.'" class="btn text-white bg-primary rounded-lg">
                              <i class="fa-solid fa-minus"></i></a>

                                '.$product['qty'].' 

                              <a href="traitement.php?action=plus&qty='.$index.'" class="btn text-white bg-primary rounded-lg">
                                <i class="fa-solid fa-plus"></i></a>
                        </td>',
                        '<td>'.number_format($product['total'], 2, ',', '&nbsp').' €</td>',
                          '<td class="">
                              <a href="traitement.php?action=delete_product&produit='.$index.'" class="btn bg-danger rounded-lg text-white text-center"><i class="fa-solid fa-trash"></i></a>
                          </td>', 
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
                          <a href="traitement.php?action=all_delete" class="btn btn-danger"> Vider le paniers </a>
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