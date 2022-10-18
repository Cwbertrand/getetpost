<?php
    session_start();

    if (isset($_POST['submit'])) {
        $produit = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qty = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT);

        if ($produit && $prix && $qty) {
            $product = [
                'produit' => $produit,
                'prix' => $prix,
                'qty' => $qty,
                'total' => $prix * $qty
            ];

            //$_SESSION['products'][] = $product;
            array_push($_SESSION['products'], $product);
        }

    }

    var_dump($_SESSION);
    //header('Location: index.php');

    