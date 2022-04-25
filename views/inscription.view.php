<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Inscrivez-vous au meilleur site de cigarette electronique" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?= URL ?>public/css/css.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= URL ?>public/images/E-cig-favicon.ico" />


    <title>
        <?php
        if (isset($_SESSION["user"]) || isset($_COOKIE['user'])) {
            echo 'Inscription';
        } else {
            echo 'Inscription';
        }
        ?>
    </title>
</head>

<body>

    <?php
    if (isset($_SESSION["user"])  || isset($_COOKIE['user'])) {
        header("Location:" . URL . "compte.view.php");
    }
    ?>

    <header>
        <?php
        GlobalController::afficheSucces();
        GlobalController::afficheEchec();
        ?>
    </header>

    <div class="inscription">
        <section class="container_form">
            <h1 class="tac">Inscription</h1>
            <form class="form" action="<?= URL ?>inscription/envoie" method="POST">
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" placeholder="Saisissez votre nom" id="nom" required>
                </div>
                <div>
                    <label for="prenom">Prenom :</label>
                    <input type="text" name="prenom" placeholder="Saisissez votre prénom" id="prenom" required>
                </div>
                <div>
                    <label for="email">Email : </label>
                    <input type="email" name="email" placeholder="Saisissez votre email" id="email" required>
                </div>
                <div>
                    <label for="date_naissance">Date de naissance : </label>
                    <input type="date" name="date" id="date_naissance" required>
                </div>
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" placeholder="Saisissez votre password" id="password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirmation mot de passe :</label>
                    <input type="password" name="confirm_password" placeholder="Saisissez votre password de confirmation" id="confirm_password" required>
                </div>
                <div>
                    <input type="submit" value="S'INSCRIRE">
                </div>


            </form>
            <p>Déjà inscrit ? <a href="<?= URL ?>compte"> Se connecter</a></p>

            <div class="return"><a href="<?= URL ?>">retour</a></div>

        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>