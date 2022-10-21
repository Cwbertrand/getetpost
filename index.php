<?php
    session_start();
?>

    <?php include './Includes/header.include.php' ?>
    

        <div class="container py-5">
            <!-- il affichage le message qui dire soit ou non (whether or not) le produit est ajouté -->
            <?php include './Includes/message.php' ?>
            <h2> Ajouter les Produit</h2>
            <form method="POST" action="traitement.php?action=add" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nomDeProduit">Produit</label>
                    <input type="text" class="form-control w-50" id="nomDeProduit" name="product_name">
                </div>
                <div class="form-group" >
                    <label for="prixunitaire">Prix</label>
                    <input type="number" min="1" step="any" class="form-control w-50" id="prixunitaire" name="prix">
                </div>
                <div class="form-group" >
                    <label for="quantity">quantity</label>
                    <input type="number" min="1" class="form-control w-25" id="quantity" name="qty">
                </div>
                <div class="form-group" >
                    <label for="descr">Description</label><br>
                        <textarea  rows="5" cols="33" name="description" id="descr" style="resize: none;"></textarea>
                </div>
                <div class="form-group" >
                    <label for="file">Fichier</label>
                    <input type="file" name="image" alt="image">
                </div>


                

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    </body>
</html>