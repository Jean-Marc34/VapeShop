<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?= URL ?>public/css/css.css" rel="stylesheet">

    <title>Modifier</title>
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

    <div class="modifier">
        <section class="container_form">
            <h1 class="tac">Vos informations</h1>
            <form class="form" action="<?= URL ?>compte/modifierOK" method="POST">
                <div>
                    <label for="email">Email : </label>
                    <input type="email" name="email" disabled value="<?= htmlspecialchars($dataUser->mail_utilisateur) ?>">
                </div>
                <div>
                    <label for="telephone">Téléphone :</label>
                    <input type="tel" name="telephone" value="<?= htmlspecialchars($dataUser->tel_utilisateur) ?>">
                </div>
                <div>
                    <label for="old_password">Mot de passe actuel :</label>
                    <input type="password" name="old_password">
                </div>
                <div>
                    <label for="new_password">Nouveau mot de passe :</label>
                    <input type="password" name="new_password">
                </div>
                <div>
                    <label for="confirm_new_password">Confirmation nouveau mot de passe :</label>
                    <input type="password" name="confirm_new_password">
                </div>
                <div>
                    <input type="submit" value="Modifier">
                </div>
            </form>

            <div class="return"><a href="<?= URL ?>compte">retour</a></div>
            <div class="row-button-delete"><button class="supprimer-compte" type="submit" value="<?= $dataUser->id_utilisateur ?>">Supprimer mon compte</button></div>

        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/js/mon-js.js"></script>
</body>

</html>