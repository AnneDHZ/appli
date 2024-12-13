<?php
// démarer la session
    session_start();
    ob_start();
// inclure la page des fonction
    include('function.php');

// vérifier si le produit existe , si oui la variable prendra la valeur id sinon il prendra la valeur null
    $id = (isset($_GET["id"])) ? $_GET["id"] : null;
       

// actions sur les produits
// si le produit existe
    if(isset($_GET["action"])) {
        //en fonction de l'action
        switch($_GET["action"]) {
            // ajouter un produit
            case "add" :
                if (isset($_POST['submit'])) {
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                    $about = filter_input(INPUT_POST, "about", FILTER_SANITIZE_STRING);
                    $img = filter_input(INPUT_POST, "img", FILTER_SANITIZE_URL);
                            
                        if($name && $price && $qtt){
                            $product = [
                                "name"=> $name,
                                "price"=> $price,
                                "qtt"=> $qtt,
                                "total"=> $price*$qtt,
                                "about"=> $about,
                                "img"=> $img
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
                    $_SESSION["messages"] = "Le produit a bien été supprimé";
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
                    // aller sur la page du produit
                        case "product": 
                            if (isset($_GET['id'])) {
                                if(isset($_SESSION["products"]) && isset($_SESSION["products"][$id])) {
                                   header("Location: product.php?id=".$_GET["id"]);  
                                }
                            exit;
                            break;
                    }
                }
            }            
                