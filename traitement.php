<?php
    session_start();
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

            //PLUS PRODUCT FROM RECAP.PHP
            case 'plus':
                if (isset($_GET['produit']) && $_SESSION['products'][$_GET['produit']]) {
                    $_SESSION['products'][$_GET['produit']]['qty']++;
                    $_SESSION['products'][$_GET['produit']]['total'] = $_SESSION['products'][$_GET['produit']]['prix'] * $_SESSION['products'][$_GET['produit']]['qty'];
                    header('Location: recap.php');
                    exit(0);
                }
                break;

            //SUBTRACT PRODUCT FROM RECAP.PHP
            case 'minus':
                if (isset($_GET['produit']) && $_SESSION['products'][$_GET['produit']]) {
                    if ($_SESSION['products'][$_GET['produit']]['qty'] >= 1){

                        $_SESSION['products'][$_GET['produit']]['qty']--;
                        $_SESSION['products'][$_GET['produit']]['total'] = $_SESSION['products'][$_GET['produit']]['prix'] * $_SESSION['products'][$_GET['produit']]['qty'];
                        header('Location: recap.php');
                        exit(0);
                    }else {
                        header('Location: recap.php');
                        exit(0);
                    }
                    
                }
                break;

            //SUPRIMER LE PRODUIT
            case 'delete_product':
                if (isset($_GET['produit']) && $_SESSION['products'][$_GET['produit']]) {
                    unset($_SESSION['products'][$_GET['produit']]);
                    header('Location: recap.php');
                    exit(0);
                }
                
                break;

            // VIDER LE PANIER
            case 'all_delete':
                    unset($_SESSION['products']);
                    header('Location: recap.php');
                    exit(0);
                
                break;
            
            default:
                # code...
                break;
        }
        # code...
    }


    
    

    