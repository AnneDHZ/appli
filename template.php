<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title><?= $title ?></title>
    </head>
    <body>
        <nav class="navbar">
            <a href="index.php">Commande</a>
            <a href="recap.php">Panier</a>
            <p><?= $totalProduits; ?> produits en session</p>
        </nav>

        <main>
            <h1 class="titre"><?= $titrePage ?></h1>

            <?php
                if(isset($_SESSION["messages"])) {
                    echo $_SESSION["messages"];
                    unset($_SESSION["messages"]);
                }
            ?>

            <?= $content ?>
        </main>

        <script>

            document.getElementById("deleteButton").addEventListener("click", function(event) {
                confirmation(event);
            })

            function confirmation(event) {
                if (!confirm("Voulez-vous vraiment supprimer cet élément ?")) {
                    event.stopPropagation();
                    event.preventDefault(); // Empêche le comportement par défaut du bouton, si nécessaire
                }
            }
        </script>
</body>
</html>