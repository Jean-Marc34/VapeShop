<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connectez-vous au meilleur site de cigarette electronique" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?= URL ?>public/css/css.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= URL ?>public/images/E-cig-favicon.ico" />


    <title>
        <?php
        if (isset($_SESSION["user"]) || isset($_COOKIE['user'])) {
            echo 'Compte';
        } else {
            echo 'Connexion';
        }
        ?>
    </title>
</head>

<body>
    <header>
        <?php

        GlobalController::afficheSucces();
        GlobalController::afficheEchec();

        ?>
    </header>

    <div class="compte">

        <section class="container_form">

            <?php if (!isset($_SESSION["user"]) && !isset($_COOKIE['user'])) { ?>
                <h1 class="tac">Connexion</h1>
                <form class="form" action="<?= URL ?>compte/connexion" method="POST">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me </label>
                    <input type="submit" value="Connexion">

                    <p>Vous n'êtes pas inscrit ? <a href="<?= URL ?>inscription">S'inscrire</a></p>
                </form>

            <?php } else { ?>
                <div class="info-user">
                    <h1 class="tac">Profil</h1>
                    <div class="container-column">
                        <div class="column">
                            <div>
                                <span>Email : <?= htmlspecialchars($dataUser->mail_utilisateur) ?></span>
                            </div>
                            <div>
                                <span>Telephone : <?= htmlspecialchars($dataUser->tel_utilisateur) ?></span>
                            </div>
                            <div>
                                <span>Prénom : <?= htmlspecialchars($dataUser->prenom_utilisateur) ?></span>
                            </div>
                        </div>
                        <div class="column">
                            <div>
                                <span>Nom : <?= htmlspecialchars($dataUser->nom_utilisateur) ?></span>
                            </div>
                            <div>
                                <span>Date de naissance : <?= htmlspecialchars($dataUser->date_naissance_utilisateur) ?></span>
                            </div>
                            <div>
                                <span>password : ********</span>
                            </div>
                        </div>
                    </div>
                    <form class="form" action="<?= URL ?>compte/modifier" method="POST">
                        <input type="submit" value="Modifier">
                    </form>
                </div>

                <div class="info-adresse">
                    <div class="info-livraison">
                        <h2 class="tac">Adresse de livraison</h2>
                        <?php if ((isset($dataLivraison)) && !empty($dataLivraison)) { ?>
                            <span>
                                <?= htmlspecialchars($dataLivraison[0]->numero_adresse) . ' ' . htmlspecialchars($dataLivraison[0]->rue_adresse) ?>
                            </span>
                            <?php if (!empty($dataLivraison[0]->complement_adresse) || ($dataLivraison[0]->complement_adresse !== "")) { ?>
                                <span>
                                    <?= htmlspecialchars($dataLivraison[0]->complement_adresse) ?>
                                </span>
                            <?php } ?>
                            <span>
                                <?= htmlspecialchars($dataLivraison[0]->code_postal_adresse) . ' ' . htmlspecialchars($dataLivraison[0]->ville_adresse) ?>
                            </span>
                            <span>
                                <?= htmlspecialchars($dataLivraison[0]->pays_adresse) ?>
                            </span>
                        <?php } else { ?>
                            <span>
                                Pas d'adresse de livraison
                            </span>
                        <?php } ?>
                        <form class="form" action="<?= URL ?>compte/livraison" method="POST">
                            <input type="submit" value="<?= (!empty($dataLivraison) ? "Modifier" : "Créer") ?>">
                        </form>
                    </div>
                    <div class="info-facturation">
                        <h2 class="tac">Adresse de facturation</h2>
                        <?php if ((isset($dataFacturation)) && !empty($dataFacturation)) { ?>
                            <span>
                                <?= htmlspecialchars($dataFacturation[0]->numero_adresse) . ' ' . htmlspecialchars($dataFacturation[0]->rue_adresse) ?>
                            </span>
                            <?php if (!empty($dataFacturation[0]->complement_adresse) || ($dataFacturation[0]->complement_adresse !== "")) { ?>
                                <span>
                                    <?= htmlspecialchars($dataFacturation[0]->complement_adresse) ?>
                                </span>
                            <?php } ?>
                            <span>
                                <?= htmlspecialchars($dataFacturation[0]->code_postal_adresse) . ' ' . htmlspecialchars($dataFacturation[0]->ville_adresse) ?>
                            </span>
                            <span>
                                <?= htmlspecialchars($dataFacturation[0]->pays_adresse) ?>
                            </span>
                        <?php } else { ?>
                            <span>
                                Pas d'adresse de facturation
                            </span>
                        <?php } ?>
                        <form class="form" action="<?= URL ?>compte/facturation" method="POST">
                            <input type="submit" value="<?= (!empty($dataFacturation) ? "Modifier" : "Créer") ?>">
                        </form>
                    </div>
                </div>

                <div class="deco"><a href="<?= URL ?>compte/deconnexion">Déconnexion</a></div>
            <?php } ?>

            <div class="return"><a href="<?= URL ?>">retour</a></div>

        </section>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>