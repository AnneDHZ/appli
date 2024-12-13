<?php


function totalProduit() {
    if (isset($_SESSION['products'])) {
        return count($_SESSION['products']);
    } else {
        return 0;
    }
}

$totalProduits = totalProduit();







?>