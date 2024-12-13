<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <title><?= $title ?></title>
    </head>
    <body>
        <nav class="navbar">
            <p>
                <a href="index.php" class="navbar-brand">Commande</a>
            </p>
            <p>
                <a href="recap.php" class="navbar-brand">Panier :</a>
                <span class="navbar-brand"><?= $totalProduits; ?> produits en session</span>
            </p>
            <!-- <p class="navbar-brand"></p> -->
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
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script>
            const deleteButtons = document.querySelectorAll('.deleteButton')
                deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener("click", (event) => {
                    confirmation(event);
                })
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