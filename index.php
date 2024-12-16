<?php
    session_start();
    ob_start();
    include('functions.php');

?>

        
        <div class="form">
            <form action="traitement.php?action=add" method="post" enctype="multipart/form-data" class="formulaire">
                <p>
                    <label class="label">
                        Nom du produit : 
                        <input type="text" name ="name" class="form-control" placeholder="Nom">
                    </label>
                </p>
                <p>
                    <label class="label">
                        Prix du produit :  
                        <input type="number" step="any" name="price" class="form-control" placeholder="0.00">
                    </label>
                </p>
                <p>
                    <label class="label">
                        Quantité désirée : 
                        <input type="number" name="qtt" value="1" class="form-control">
                    </label>
                </p>
                <p>
                    <label class="label">
                        Descritption du produit :
                    <textarea name="about" id="" class="form-control" placeholder="Il est beau mais pas que! Il est aussi..."></textarea>
                    </label>
                </p>
                <p>
                    <label for="file" class="label">
                        Envoyer un fichier :
                        <input type="file" name="file" class="form-control">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-outline-success one">
                </p>
            </form>    
        </div>
        
<?php    
$content = ob_get_clean();
$title = "Ajouter un produit";
$titrePage = "Ajouter un produit";
require_once "template.php";
require_once "bdd.php";
?>
