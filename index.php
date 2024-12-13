<?php
    session_start();
    ob_start();
    include('functions.php');

?>

        
        <div class="form">
            <form action="traitement.php?action=add" method="post" class="formulaire">
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
                    <label class="label">
                        URL de l'image :
                        <input type="url" name="img" id="" class="form-control" placeholder="www.">
                    </label>
                </p>
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <label for="file">ou <br>Envoyer un fichier :</label>
                        <input type="file" name="file" class="form-control">
                        
                </form>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-outline-success">
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