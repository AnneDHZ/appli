<?php
    session_start();
    include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Récapitulatif des produits</title>
    
        
        
    </head>
    <body>
        <nav class="navbar">
            <a href="index.php">Commande</a>
            <a href="recap.php">Panier</a>
            <p><?php echo $totalProduits; ?> produits en session</p>
        </nav>

       

        <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p> Aucun produit en session...</p>";
        }
        else{
            echo "<table border=1>",
                    "<thead>",
                    "<tr>",
                    "<th>#</th>",
                    "<th>Nom</th>",
                    "<th>Prix</th>",
                    "<th>Quantité</th>",
                    "<th>Total</th>",
                    "<th>Supp</th>",
                    "</tr>",
                    "</thead>",
                    "<tbody>";
                    $totalGeneral = 0;
                    foreach($_SESSION['products'] as $index =>$product){
                        echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ", ", "&nbsp"). "&nbsp;€</td>",
                        "<td><a href='traitement.php?action=down-qtt&id=$index'>-</a>".$product['qtt']."<a href='traitement.php?action=up-qtt&id=$index'>+</a></td>",
                        "<td>".number_format($product['total'], 2, ", ", "&nbsp"). "&nbsp;€</td>",
                        "<td><a href='traitement.php?action=delete&id=$index'>Supprimer le produit</a></td>",
                        "</tr>";
                        $totalGeneral += $product['total'];
                    }
                        echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ", ", "&nbsp"). "&nbsp;€</td>",
                        "</tr>",
                        "</tbody>",
                        "</ttable>";
                    }
                    ?>



<a href="traitement.php?action=clear">Vider le panier</a>
</body>
</html>

