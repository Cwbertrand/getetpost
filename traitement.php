<?php
    session_start();
    
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                // CREER LA TABLE
                if (isset($_POST['submit'])) {
                    
                    $produit = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_SPECIAL_CHARS);
                    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
                    $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qty = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT);


                    $imagename = $_FILES['image']['name'];
                    $imagepath = $_FILES['image']['full_path'];
                    $imageType = $_FILES['image']['type'];
                    $imagetmpName = $_FILES['image']['tmp_name'];
                    $imageerror = $_FILES['image']['error'];
                    $imageSize = $_FILES['image']['size'];
            
                    $tabExtension = explode('.', $imagename);  // The function explode allows to cut a character string into several pieces from a delimiter
                                                        // example: explode(“.”, “image.jpg”) will become ["image", "jpg"]

                    $extension = strtolower(end($tabExtension));    //The strtolower function allows you to lowercase an entire string and "END" takes the last value of the array

                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];    //Table of extensions that we accept

                    $maxSize = 400000; //maximum size to compare with $imageSize

                    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0 && $produit && $description && $prix && $qty) {
                        
                        $uniqueName = uniqid('', true); //PHP function uniqid (). It expects 2 parameters. The first is a character string that will serve as a prefix and the second is a boolean (true / false) that increases the size of the generated string for more security.
                        
                        $file = $uniqueName.".".$extension;
                        //$file = 5f586bf96dcd38.73540086.jpg
                        
                        move_uploaded_file($imagetmpName, './images/'.$file);    //creating a folder where the images will be uploaded to
                        
                        $product = [
                            'image' => $file,
                            'produit' => $produit,
                            'description' => $description,
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
                    if ($_SESSION['products'][$_GET['produit']]['qty'] > 1){

                        $_SESSION['products'][$_GET['produit']]['qty']--;
                        $_SESSION['products'][$_GET['produit']]['total'] = $_SESSION['products'][$_GET['produit']]['prix'] * $_SESSION['products'][$_GET['produit']]['qty'];
                        header('Location: recap.php');
                        exit(0);
                    }else {
                        unset($_SESSION['products'][$_GET['produit']]);
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
                }else{
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


    
    

    