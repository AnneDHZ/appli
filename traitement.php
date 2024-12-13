<?php
// démarer la session
    session_start();
    ob_start();
// inclure les pages
    include('function.php');
    include('bdd.php');

// vérifier si le produit existe , si oui la variable prendra la valeur id sinon il prendra la valeur null
    $id = (isset($_GET["id"])) ? $_GET["id"] : null;
    // variables pour les fichiers envoyés
    if(isset($_FILES['file'])){
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];   
    }

    
//donne le nom du fichier sans les points
    $tabExtension = explode('.', $name);
//mets tt les caractères en minuscules et prend la fin des caractères après le dernier point du nom du fichier donc le type
    $extension = strtolower(end($tabExtension));
    //Tableau des extensions que l'on accepte
$extensions = ['jpg', 'png', 'jpeg', 'gif'];
//Taille max que l'on accepte
$maxSize = 400000;
   //vérifier l'extension et la taille
    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
        //génère un nom unique avec uniqid
        $uniqueName = uniqid('', true);
    //ajoute l'extension au nom du fichier
    $file = $uniqueName.".".$extension;
        //envoyer l’image dans notre dossier
        move_uploaded_file($tmpName, './upload/'.$file);
    }
    else{
        echo "Mauvaise extension";
    }

    $req = $db->prepare('INSERT INTO file (name) VALUES (?)');
    $req->execute([$file]);
    echo "Image enregistrée";

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
                