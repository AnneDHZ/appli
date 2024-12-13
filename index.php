<?php
    session_start();
    ob_start();
    include('functions.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
            
        
    </head>
    <body>
        <nav class="navbar">
            <a href="index.php">Commande</a>
            <a href="recap.php">Panier</a>
            <p><?php echo $totalProduits; ?> produits en session</p>
        </nav>

        
</body>
</html>

        <h1 class="titre">Ajouter un produit</h1>
        
        <div class="form">
            <form action="traitement.php?action=add" method="post" class="formulaire">
                <p>
                    <label class="label">
                        Nom du produit : 
                        <input type="text" name ="name" class="input">
                    </label>
                </p>
                <p>
                    <label class="label">
                        Prix du produit :  
                        <input type="number" step="any" name="price" class="input">
                    </label>
                </p>
                <p>
                    <label class="label">
                        Quantité désirée : 
                        <input type="number" name="qtt" value="1" class="input">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="submit">
                </p>
            </form>    
        </div>

   