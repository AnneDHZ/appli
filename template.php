<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$headerNavbar = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    <?php
        switch ($headerNavbar){
            case "index": ($_SERVER['PHP_SELF'] == '/index.php');
                echo "<title>Ajout produit</title>";
                break;
            case "recap": ($_SERVER['PHP_SELF'] == '/recap.php');
                echo "<title>Récapitulatif des produits</title>";
                break; 
            case "autre":
                echo "<title>Mon site</title>";
                break;
        }    
    ?>
        
        
    </head>
    <body>
        <nav class="navbar">
            <a href="index.php">Commande</a>
            <a href="recap.php">Panier</a>
            <p><?php echo $totalProduits; ?> produits en session</p>
        </nav>

        <?php echo $content ?>

</body>
</html>