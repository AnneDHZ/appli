<?php
// démarer la session
    session_start();
    ob_start();
// inclure les pages
    include('functions.php');
    include('bdd.php');

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

                    // variables pour les fichiers envoyés
                    if(isset($_FILES['file'])){
                        $tmpName = $_FILES['file']['tmp_name'];
                        $name = $_FILES['file']['name'];
                        $size = $_FILES['file']['size'];
                        //donne le nom du fichier sans les points
                        $tabExtension = explode('.', $name);
                        //mets tt les caractères en minuscules et prend la fin des caractères après le dernier point du nom du fichier donc le type
                        $extension = strtolower(end($tabExtension));
                        //Taille max que l'on accepte
                        $maxSize = 400000;

                        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                            // récupérer le tipe MIME du fichier
                            $mime_type = mime_content_type($_FILES['file']['tmp_name']);

                            // restreindre à une liste de type de fichiers
                            $allowed_file_types = ['image/png', 'image/jpeg'];
                            if (!in_array($mime_type, $allowed_file_types) && $size >= $maxSize) {
                                $_SESSION["messages"] = "Mauvaise extension ou taille trop importante";
                                header("Location: index.php");
                                exit;
                            }
                        
                            $uniqueName = uniqid('', true);
                            //ajoute l'extension au nom du fichier
                            $file = $uniqueName.".".$extension;

                            // telecharge le fichier dans le dossier avec un message de confirmation
                            if (move_uploaded_file($tmpName, './upload/'.$file)) {
                                $_SESSION["messages"] = "Fichier transféré";
                            }
                        }

                    }
                    //donne le reste des champs
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                    $about = filter_input(INPUT_POST, "about", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                    if($name && $price && $qtt && $about){
                        $product = [
                            "name"=> $name,
                            "price"=> $price,
                            "qtt"=> $qtt,
                            "total"=> $price*$qtt,
                            "about"=> $about,
                            //récupéré dans le dossier upload
                            "img"=> $file
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
                exit();
                break;
                }
        }
    }            
                