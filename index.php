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
                    <label class="label">
                        Descritption du produit :
                    <textarea name="about" id=""></textarea>
                    </label>
                </p>
                <p>
                    <label class="label">
                        URL de l'image :
                        <input type="url" name="img" id="">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="submit">
                </p>
            </form>    
        </div>
        
    <?php    
    $content = ob_get_clean();
    $title = "Ajouter un produit";
    $titrePage = "Ajouter un produit";
    require_once "template.php";
    ?>