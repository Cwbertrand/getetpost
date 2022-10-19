<?php

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                // CREER LA TABLE
                if (isset($_POST['submit'])) {
                    $produit = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_SPECIAL_CHARS);
                    $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qty = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT);
                    //$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

                    if ($produit && $prix && $qty) {
                        $product = [
                            'produit' => $produit,
                            'prix' => $prix,
                            'qty' => $qty,
                            'total' => $prix * $qty,
                        ];
                        
                        //this creates a table when you press the submit button
                        //the $_SESSION['product'] creates the table and [] just adds.
                        $_SESSION['products'][] = $product;
                        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Salut!</strong> la produit est ajouter successivement </div>';
                        header('Location: index.php');
                        exit(0);
                        
                        //array_push($_SESSION['products'], $product); 
                        //this does that also but on an already existing table
                    }else {
                        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Salut!</strong> la produit n\'est pas ajouter, reessayer encore </div>';
                        header('Location: index.php');
                        exit(0);
                    }
                }
                break;
            case 'all_delete':
                // VIDER LE PANIER
                if (isset($_GET['all_delete']) && $_GET['all_delete'] === $_SESSION['all_delete']) {

                        unset($_SESSION['products']);
                    }

                break;
            
            default:
                # code...
                break;
        }
        # code...
    }

    

    