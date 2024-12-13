<?php
    session_start();
    ob_start();
    include('functions.php');

?>



        <?php 
       

        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p> Aucun produit en session...</p>";
        }
        else{
            echo "<table class='table table-striped'>",
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
                        "<td><a href='traitement.php?action=product&id=$index'>".$product['name']."</a></td>",
                        "<td>".number_format($product['price'], 2, ", ", "&nbsp"). "&nbsp;€</td>",
                        "<td><a class='btn btn-outline-secondary btn-left' href='traitement.php?action=down-qtt&id=$index'>-</a>" . $product['qtt'] . "<a class='btn btn-outline-secondary btn-right' href='traitement.php?action=up-qtt&id=$index'> + </a></td>",
                        "<td>".number_format($product['total'], 2, ", ", "&nbsp"). "&nbsp;€</td>",
                        "<td><a class='btn btn-outline-danger deleteButton' href='traitement.php?action=delete&id=$index'>Supprimer le produit</a></td>",
                        "</tr>";
                        $totalGeneral += $product['total'];
                    }
                        echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ", ", "&nbsp"). "&nbsp;€</td>",
                        "</tr>",
                        "</tbody>",
                        "</table>";
                    }
                    ?>




<a href="traitement.php?action=clear" class="btn btn-outline-danger">Vider le panier</a>


<?php
$content = ob_get_clean();
$title = "Panier";
$titrePage = "Mon panier";
require_once "template.php";
?>

