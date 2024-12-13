<?php
    session_start();
    ob_start();
    
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    if (isset($_SESSION['products'][$id])) {
        $product = $_SESSION['products'][$id];  
    }
    include('functions.php');
?>


<div>
        <!-- * les champs présents dans cette page doivent être renseigné dans la page index.php -->
        <h1><?= $product['name'];?></h1>
        <img src="<?=$product['img']?>" alt="" class="img"> 
        <p>
        <?= $product['about'];?>
        </p>
        <p class="prix"><?= number_format($product['price'], 2, ", ", "&nbsp;") ?> €</p>
</div>

<?php    
    $content = ob_get_clean();
    $title = "Nom du produit";
    $titrePage = "Produit";
    require_once "template.php";
?>
