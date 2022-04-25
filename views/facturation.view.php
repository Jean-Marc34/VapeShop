<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?= URL ?>public/css/css.css" rel="stylesheet">

    <title>Modification adresse facturation</title>
</head>

<body>

    <?php
    if ((!isset($_SESSION["user"]))  && (!isset($_COOKIE['user']))) {
        header("Location:" . URL . "compte");
    }
    ?>

    <header>
        <?php
        GlobalController::afficheSucces();
        GlobalController::afficheEchec();
        ?>
    </header>

    <div class="facturation">
        <section class="container_form">
            <h1 class="tac">Adresse de facturation</h1>
            <form class="form" action="<?= URL ?>compte/facturationOK" method="POST">
                <div>
                    <label for="numero">Numéro de rue : </label>
                    <input type="text" name="numero" required value="<?= (!empty($dataFacturation) ? htmlspecialchars($dataFacturation[0]->numero_adresse) : "") ?>">
                </div>
                <div>
                    <label for="rue">Rue : </label>
                    <input type="text" name="rue" required value="<?= (!empty($dataFacturation) ? htmlspecialchars($dataFacturation[0]->rue_adresse) : "") ?>">
                </div>
                <div>
                    <label for="complement">Complément (si nécessaire) :</label>
                    <input type="text" name="complement" value="<?= (!empty($dataFacturation) ? htmlspecialchars($dataFacturation[0]->complement_adresse) : "") ?>">
                </div>
                <div>
                    <label for="code">Code postal : </label>
                    <input type="text" name="code" required value="<?= (!empty($dataFacturation) ? htmlspecialchars($dataFacturation[0]->code_postal_adresse) : "") ?>">
                </div>
                <div>
                    <label for="ville">Ville : </label>
                    <input type="text" name="ville" required value="<?= (!empty($dataFacturation) ? htmlspecialchars($dataFacturation[0]->ville_adresse) : "") ?>">
                </div>
                <div>
                    <label for="pays">Pays :</label>
                    <input type="text" name="pays" required value="<?= (!empty($dataFacturation) ? htmlspecialchars($dataFacturation[0]->pays_adresse) : "") ?>">
                </div>
                <div>
                    <input type="submit" value="<?= (!empty($dataFacturation) ? "Modifier" : "Créer") ?>">
                </div>
            </form>

            <div class="return"><a href="<?= URL ?>compte">retour</a></div>
            <?php if (!empty($dataFacturation)) {
                echo '
            <div class="row-button-delete"><button class="supprimer-adresse" type="submit" value="' . $dataFacturation[0]->id_adresse . '">Supprimer</button></div>
            ';
            } ?>
        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/js/mon-js.js"></script>
</body>

</html>