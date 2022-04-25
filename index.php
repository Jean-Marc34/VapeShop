<?php
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once "./controllers/ShopController.controller.php";
$shopController = new ShopController();
//$idPanier = $shopController->getIdPanier();
$admin = (isset($_SESSION['admin']) || isset($_COOKIE['admin']));
if (empty($_GET["page"])) {
    $produits = $shopController->getAllProduits();
    $caracteristique = $shopController->getAllcaracteristique();
    require_once "./views/accueil.view.php";
} else {
    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
    //var_dump($url);
    try {
        switch ($url[0]) {
            case "accueil":
                if (!empty($url[1])) {
                    throw new Exception('URL après accueil non attendue');
                } else {
                    $produits = $shopController->getAllProduits();
                    $caracteristique = $shopController->getAllcaracteristique();
                    require_once "./views/accueil.view.php";
                }
                break;
            case "apropos":
                if (!empty($url[1])) {
                    throw new Exception('URL après à propos non attendue');
                } else {
                    require_once "./views/apropos.view.php";
                }
                break;
            case "contact":
                if (!empty($url[1])) {
                    throw new Exception('URL après contact non attendue');
                } else {
                    require_once "./views/contact.view.php";
                }
                break;
            case "compte":
                if (empty($url[1])) {
                    $shopController->compte();
                } else {
                    switch ($url[1]) {
                        case "connexion":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue après connexion');
                            } else {
                                $shopController->connexion();
                            }
                            break;
                        case "deconnexion":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue deconnexion');
                            } else {
                                $shopController->deconnexion();
                            }
                            break;
                        case "modifier":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue modifier');
                            } else {
                                $shopController->modifier();
                            }
                            break;
                        case "livraison":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue livraison');
                            } else {
                                $shopController->livraison();
                            }
                            break;
                        case "facturation":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue facturation');
                            } else {
                                $shopController->facturation();
                            }
                            break;
                        case "modifierOK":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue modifierOK');
                            } else {
                                $shopController->modifierOK();
                            }
                            break;
                        case "livraisonOK":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue livraisonOK');
                            } else {
                                $shopController->livraisonOK();
                            }
                            break;
                        case "facturationOK":
                            if (!empty($url[2])) {
                                throw new Exception('URL2 inattendue facturationOK');
                            } else {
                                $shopController->facturationOK();
                            }
                            break;
                        case "suppressionAdresse":
                            if (empty($url[2])) {
                                throw new Exception('URL2 attendue après suppressionAdresse');
                            } else if (!empty($url[3])) {
                                throw new Exception('URL3 inattendue suppressionAdresse');
                            } else {
                                $shopController->suppressionAdresse($url[2]);
                            }
                            break;
                        case "suppressionCompte":
                            if (empty($url[2])) {
                                throw new Exception('URL2 attendue après suppressionCompte');
                            } else if (!empty($url[3])) {
                                throw new Exception('URL3 inattendue suppressionCompte');
                            } else {
                                $shopController->suppressionCompte($url[2]);
                            }
                            break;
                        default:
                            throw new Exception('URL1 inattendue');
                    }
                }
                break;
            case "inscription":
                if (empty($url[1])) {
                    $shopController->inscription();
                } else {
                    if (!empty($url[2])) {
                        throw new Exception('URL2 inattendue');
                    } else {
                        switch ($url[1]) {
                            case "envoie":
                                $shopController->inscriptionValidation();
                                break;
                            default:
                                throw new Exception('URL1 inattendue');
                        }
                    }
                }
                break;
            case "api":
                if (empty($url[1])) {
                    throw new Exception('URL1 attendue après api');
                } else {
                    switch ($url[1]) {
                        case 'infoProduit':
                            if (empty($url[2])) {
                                throw new Exception('URL2 attendue après infoProduit');
                            } else {
                                $shopController->demandeInfoProduit($url[2]);
                            }
                            break;
                        case 'suppressionProduit':
                            if (empty($url[2])) {
                                throw new Exception('URL2 attendue après suppressionProduit');
                            } else {
                                $shopController->demandeSuppressionProduit($url[2]);
                            }
                            break;
                        case 'modifierProduit':
                            if (empty($url[2])) {
                                throw new Exception('URL2 attendue après modifierProduit');
                            } else {
                                // var_dump($_POST["parfum"]);
                                // var_dump($_POST["prix"]);exit;
                                $shopController->demandeModifierProduit($url[2], $_FILES["image"], $_POST["parfum"], $_POST["prix"], $_POST["quantite"], $_FILES["image"]["name"]);
                            }
                            break;
                        default:
                            throw new Exception('URL1 mauvaise après api');
                            break;
                    }
                }
                break;
            case "produit":
                if (empty($url[1])) {
                    throw new Exception('URL attendue après produit');
                } else {
                    if (!empty($url[2])) {
                        throw new Exception('URL2 inattendue après produit');
                    } else {
                        switch ($url[1]) {
                            case 'ajouter':
                                $shopController->ajouterProduit();
                                break;
                            case 'ajouterOk':
                                $shopController->ajouterProduitOk($_FILES["image"], $_POST["parfum"], $_POST["prix"], $_POST["quantite"], $_FILES["image"]["name"]);
                                break;
                            case 'lister':
                                //$produits = $shopController->getAllProduits();
                                $shopController->listerProduits();
                                break;
                            default:
                                throw new Exception('URL1 mauvaise après produit');
                                break;
                        }
                    }
                }
                break;
            case "panier":
                if (!empty($url[1])) {
                    throw new Exception('URL après panier non attendue');
                } else {
                    require_once "./views/panier.view.php";
                }
                break;
            default:
                GlobalController::setEchec("Problème de routage");
                require_once "./views/404.view.php";
        }
    } catch (Exception $e) {
        GlobalController::setEchec($e->getMessage());
        require_once "./views/404.view.php";
    }
}
