<?php
// démarer la session
    session_start();
    ob_start();
// inclure la page des fonction
    include('function.php');


    $id = (isset($_GET["id"])) ? $_GET["id"] : null;
       

// actions sur les produits
    if(isset($_GET["action"])) {
        switch($_GET["action"]) {
            // ajouter un produit
            case "add" :
                if (isset($_POST['submit'])) {
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                            
                        if($name && $price && $qtt){
                            $product = [
                                "name"=> $name,
                                "price"=> $price,
                                "qtt"=> $qtt,
                                "total"=> $price*$qtt
                            ];
                            $_SESSION['products'][] = $product;
                        }
                }
                        
                    header("Location: index.php"); 
                    exit();
                break;
            // supprimer le produit
            case "delete":
                if(isset($_SESSION["products"]) && isset($_SESSION["products"][$id])) {
                    unset($_SESSION["products"][$id]);
                    header("Location: recap.php");
                    exit;
                }
                break;
            // vider le panier
            case "clear": 
                if(isset($_SESSION["products"])) {
                    unset($_SESSION["products"]);
                    header("Location: recap.php");
                }
                    exit;
                break;
            //augmenter la quantité
            case "up-qtt": 
                if (isset($_GET['id'])) {
                    if(isset($_SESSION["products"]) && isset($_SESSION["products"][$id])) {
                        $_SESSION['products'][$id]['qtt'] += 1;  
                        $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];  
                    }
                }
                    header("Location: recap.php");  
                    exit();
                    break;
                // diminuer la quantité
                case "down-qtt": 
                    if (isset($_GET['id'])) { 
                        if(isset($_SESSION["products"]) && isset($_SESSION["products"][$id])) {
                            if ($_SESSION['products'][$id]['qtt'] > 1) {
                                $_SESSION['products'][$id]['qtt'] -= 1;  
                                $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];  
                            }
                            else {
                                unset($_SESSION["products"][$id]);
                            } 
                        }
                    }
                    header("Location: recap.php");  
                    break;
        }
    }

