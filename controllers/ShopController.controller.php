<?php
include_once "./models/shopManager.class.php";
include_once "./controllers/GlobalController.controller.php";
class ShopController
{

    private $shopManager;

    function __construct()
    {
        $this->shopManager = new ShopManager();
        //$this->shopManager->loadingPanier();
    }

    public function setshopManager($shopManager)
    {
        $this->shopManager = $shopManager;
        return $this;
    }
    public function getshopManager()
    {
        return $this->shopManager;
    }

    public function displayAPropos()
    {
        require_once "./views/apropos.view.php";
    }

    public function contact()
    {
        require_once "./views/contact.view.php";
    }

    public function inscription()
    {
        require_once "./views/inscription.view.php";
    }

    public function inscriptionValidation()
    {
        $currentDate = time();
        try {
            if (
                empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['date']) || empty($_POST['email'])
                || empty($_POST['password']) || empty($_POST['confirm_password'])
            ) {
                throw new Exception("Champs de saisi manquant");
            } else if ($_POST['password'] !== $_POST['confirm_password']) {
                throw new Exception("Les mots de passe doivent être identiques");
            } else if (($currentDate - strtotime($_POST['date'])) < 567907200) {
                throw new Exception("Vous devez avoir plus de 18 ans pour pouvoir vous inscrire");
            } else {
                //!!Vérifier l'existence du mail
                $result = $this->shopManager->getUserEmail($_POST['email']);
                if ($result) {
                    throw new Exception("Cet email existe déjà");
                } else {
                    $result = $this->shopManager->setUser($_POST['nom'], $_POST['prenom'], $_POST['date'], $_POST['email'], $_POST['password']);
                    if ($result) {
                        GlobalController::setSucces("Votre inscription est un succès !");
                        header("location:" . URL . "compte");
                    } else {
                        throw new Exception("Votre inscription est un échec !");
                    }
                }
            }
        } catch (Exception $e) {
            GlobalController::setEchec($e->getMessage());
            require_once "./views/inscription.view.php";
        }
    }

    public function connexion()
    {
        try {
            if (empty($_POST['email']) || empty($_POST['password'])) {
                throw new Exception("Champs de saisi manquant");
            } else {
                $result = $this->shopManager->getUserEmail($_POST['email']);
                if ($result) {
                    $result = $this->shopManager->getUserInfo($_POST['email']);
                    if (password_verify($_POST['password'], $result->password_utilisateur)) {
                        //Connexion
                        //$this->shopManager->connexionOK();
                        $_SESSION["user"] = $_POST['email'];
                        $_SESSION["userId"] = $result->id_utilisateur;
                        if (isset($_POST['remember'])) {
                            setcookie('user', $_POST['email'], time() + 31556926, "/"); //temps actuel + 1 an;
                            setcookie('userId', $result->id_utilisateur, time() + 31556926, "/"); //temps actuel + 1 an;
                        }
                        if ($this->shopManager->isAdmin($result->id_utilisateur)) {
                            $_SESSION["admin"] = true;
                            if (isset($_POST['remember'])) {
                                setcookie('admin', true, time() + 31556926, "/"); //temps actuel + 1 an;
                            }
                        }
                        GlobalController::setSucces("Vous êtes connecté(e)");
                        header("Location: " . URL . "compte");
                    } else {
                        throw new Exception("Mot de passe incorrect");
                    }
                } else {
                    throw new Exception("Email incorrect");
                }
            }
        } catch (Exception $e) {
            GlobalController::setEchec($e->getMessage());
            require_once "./views/compte.view.php";
        }
    }

    public function deconnexion()
    {
        session_destroy();
        session_start();
        setcookie('user', "", time() - 1, "/"); //destruction du cookie
        setcookie('userId', "", time() - 1, "/"); //destruction du cookie
        setcookie('admin', "", time() - 1, "/"); //destruction du cookie
        $admin = false;
        GlobalController::setSucces("Vous êtes déconnecté(e)");
        header("Location: " . URL . "compte");
    }

    public function compte()
    {
        if (isset($_SESSION["user"]) || isset($_COOKIE["user"])) {
            $dataUser = $this->shopManager->getUserInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
            $dataLivraison = $this->shopManager->getLivraisonInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
            $dataFacturation = $this->shopManager->getFacturationInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
        }
        require_once "./views/compte.view.php";
    }

    public function modifier()
    {
        $dataUser = $this->shopManager->getUserInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
        require_once "./views/modifier.view.php";
    }

    public function modifierOK()
    {
        if (empty($_POST["telephone"]) && empty($_POST["old_password"]) && empty($_POST["new_password"]) && empty($_POST["confirm_new_password"])) {
            GlobalController::setEchec("Aucune modification demandée.");
        } else {
            if (empty($_POST["telephone"])) {
                $tel = "";
            } else {
                $regex = "/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/";
                preg_match($regex, $_POST["telephone"], $match);
                if ($match && ($_POST["telephone"] !== 0)) {
                    $tel = $_POST["telephone"];
                } else {
                    GlobalController::setEchec("Mauvais format de numéro de téléphone. ");
                }
            }

            if (empty($_POST["old_password"]) && empty($_POST["new_password"]) && empty($_POST["confirm_new_password"])) {
                $password = "";
            } else {
                if (empty($_POST["old_password"]) || empty($_POST["new_password"]) || empty($_POST["confirm_new_password"])) {
                    GlobalController::setEchec("Tous les mots de passe doivent être rempli.");
                } else if ($_POST["new_password"] !== $_POST["confirm_new_password"]) {
                    GlobalController::setEchec("Les 2 nouveaux mots de passe doivent être identiques.");
                } else {
                    $result = $this->shopManager->getUserPassword(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
                    if (password_verify($_POST['old_password'], $result[0]->password_utilisateur)) {
                        $password = $_POST["new_password"];
                    } else {
                        GlobalController::setEchec("Mot de passe incorrect.");
                    }
                }
            }
        }
        if (!empty($_SESSION["echec"])) {
            $dataUser = $this->shopManager->getUserInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
            require_once "./views/modifier.view.php";
        } else {
            $result = $this->shopManager->updateUserInfo($tel, $password);
            if ($result) {
                GlobalController::setSucces("Vos informations ont bien été mise à jour.");
            } else {
                GlobalController::setEchec("Vos informations n'ont pas pu être mise à jour.");
            }
            $this->compte();
        }
    }

    public function suppressionCompte($id)
    {
        $result = $this->shopManager->deleteCompte($id);
        if ($result) {
            session_destroy();
            session_start();
            setcookie('user'); //destruction du cookie
            setcookie('userId'); //destruction du cookie
            setcookie('admin'); //destruction du cookie
            $admin = false;
            GlobalController::setSucces("Votre compte a bien été supprimée.");
        } else {
            GlobalController::setEchec("Votre compte n'a pas pu être supprimée.");
        }
        $this->compte();
    }

    public function livraison()
    {
        $dataLivraison = $this->shopManager->getLivraisonInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
        require_once "./views/livraison.view.php";
    }

    public function livraisonOK()
    {
        $dataLivraison = $this->shopManager->getLivraisonInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
        if (empty($_POST["numero"]) || empty($_POST["rue"]) || empty($_POST["code"]) || empty($_POST["ville"]) || empty($_POST["pays"])) {
            GlobalController::setEchec("Champs manquants");
            require_once "./views/livraison.view.php";
        } else {
            if ($dataLivraison) {
                $result = $this->shopManager->updateLivraisonInfo($_POST["numero"], $_POST["rue"], $_POST["complement"], $_POST["code"], $_POST["ville"], $_POST["pays"], $dataLivraison[0]->id_adresse);
            } else {
                $result = $this->shopManager->setLivraisonInfo($_POST["numero"], $_POST["rue"], $_POST["complement"], $_POST["code"], $_POST["ville"], $_POST["pays"]);
            }
            if ($result) {
                GlobalController::setSucces("Votre adresse de livraison a bien été mise à jour.");
            } else {
                GlobalController::setEchec("Votre adresse de livraison n'a pas pu être mise à jour.");
            }
            $this->compte();
        }
    }

    public function facturation()
    {
        $dataFacturation = $this->shopManager->getFacturationInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
        require_once "./views/facturation.view.php";
    }

    public function facturationOK()
    {
        $dataFacturation = $this->shopManager->getFacturationInfo(empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]);
        if (empty($_POST["numero"]) || empty($_POST["rue"]) || empty($_POST["code"]) || empty($_POST["ville"]) || empty($_POST["pays"])) {
            GlobalController::setEchec("Champs manquants");
            require_once "./views/facturation.view.php";
        } else {
            if ($dataFacturation) {
                $result = $this->shopManager->updateFacturationInfo($_POST["numero"], $_POST["rue"], $_POST["complement"], $_POST["code"], $_POST["ville"], $_POST["pays"], $dataFacturation[0]->id_adresse);
            } else {
                $result = $this->shopManager->setFacturationInfo($_POST["numero"], $_POST["rue"], $_POST["complement"], $_POST["code"], $_POST["ville"], $_POST["pays"]);
            }
            if ($result) {
                GlobalController::setSucces("Votre adresse de facturation a bien été mise à jour.");
            } else {
                GlobalController::setEchec("Votre adresse de facturation n'a pas pu être mise à jour.");
            }
            $this->compte();
        }
    }

    public function suppressionAdresse($id)
    {
        $result = $this->shopManager->deleteAdresse($id);
        if ($result) {
            GlobalController::setSucces("Votre adresse a bien été supprimée.");
        } else {
            GlobalController::setEchec("Votre adresse n'a pas pu être supprimée.");
        }
        $this->compte();
    }

    public function listerProduits()
    {
        $admin = (isset($_SESSION['admin']) || isset($_COOKIE['admin']));
        $produits = $this->shopManager->getProduits();
        require_once "./views/liste_produits.view.php";
    }

    public function ajouterProduit()
    {
        $admin = (isset($_SESSION['admin']) || isset($_COOKIE['admin']));
        require_once "./views/ajout_produit.view.php";
    }

    public function ajouterProduitOk($fileImage, $parfum, $prix, $quantite, $image)
    {
        try {
            if (empty($fileImage) || empty($parfum) || empty($prix) || empty($quantite) || empty($image)) {
                throw new Exception('Champs de saisi manquant.');
                // } else if (preg_match("/^[0-9]*[1-9][0-9]*(,[0-9]*)?|[0-9]*(,[0-9]*[1-9][0-9]*)?$/", $prix)) {
            } else if (!preg_match("/^(?!0*[.,]0*$|[.,]0*$|0*$)\d+[,.]?\d{0,2}$/", $prix)) {
                throw new Exception("Le prix saisie n'est pas un nombre décimal positif.");
            } else if (preg_match("/[^0-9]/", $quantite)) {
                throw new Exception("La quantité saisie n'est pas un entier.");
            } else {
                $nom_image = str_replace(" ", "_", $image);
                $prix = str_replace(",", ".", $prix);
                // var_dump($fileImage, $nom_image, $image);
                // exit;
                GlobalController::addImage($fileImage, $nom_image);
                if (file_exists("public/images/" . $nom_image)) {
                    $result = $this->shopManager->setProduit($parfum, $prix, $quantite, $nom_image);
                    if ($result) {
                        GlobalController::setSucces("Produit ajouté avec succès.");
                        header("location:" . URL . "produit/ajouter");
                    } else {
                        throw new Exception("Problème lors de l'ajout en BDD");
                    }
                } else {
                    throw new Exception("Produit non enregistrer car problème avec l'upload de l'image.");
                }
            }
        } catch (Exception $e) {
            GlobalController::setEchec($e->getMessage());
            //require_once "./views/ajout_produit.view.php";
            header("location:" . URL . "produit/ajouter");
        }
    }

    public function demandeModifierProduit($id, $fileImage, $parfum, $prix, $quantite, $image)
    {
        try {
            if (empty($parfum) || empty($prix) || empty($quantite)) {
                throw new Exception('Champs de saisi manquant.');
                // } else if (preg_match("/^[0-9]*[1-9][0-9]*(,[0-9]*)?|[0-9]*(,[0-9]*[1-9][0-9]*)?$/", $prix)) {
            } else if (!preg_match("/^(?!0*[.,]0*$|[.,]0*$|0*$)\d+[,.]?\d{0,2}$/", $prix)) {
                throw new Exception("Le prix saisie n'est pas un nombre décimal positif.");
            } else if (preg_match("/[^0-9]/", $quantite)) {
                throw new Exception("La quantité saisie n'est pas un entier.");
            } else {
                $prix = str_replace(",", ".", $prix);
                if (!empty($image)) {
                    $nom_image = str_replace(" ", "_", $image);
                    GlobalController::addImage($fileImage, $nom_image);
                    if (file_exists("public/images/" . $nom_image)) {
                        $result = $this->shopManager->updateProduit($id, $parfum, $prix, $quantite, $image);
                        if ($result) {
                            GlobalController::setSucces("Produit modifié avec succès.");
                            header("location:" . URL . "produit/lister");
                            //require_once "./views/liste_produits.view.php";
                        } else {
                            throw new Exception("Problème lors de la modificaion en BDD");
                        }
                    } else {
                        throw new Exception("Produit non modifier car problème avec l'upload de l'image.");
                    }
                } else {
                    $result = $this->shopManager->updateProduitSansImage($id, $parfum, $prix, $quantite);
                    if ($result) {
                        GlobalController::setSucces("Produit modifié avec succès.");
                        // header("location:" . URL . "produit/lister");
                        $admin = (isset($_SESSION['admin']) || isset($_COOKIE['admin']));
                        $produits = $this->shopManager->getProduits();
                        require_once "./views/liste_produits.view.php";
                    } else {
                        throw new Exception("Problème lors de la modification en BDD");
                    }
                }
            }
        } catch (Exception $e) {
            GlobalController::setEchec($e->getMessage());
            $admin = (isset($_SESSION['admin']) || isset($_COOKIE['admin']));
            $produits = $this->shopManager->getProduits();
            require_once "./views/liste_produits.view.php";
            // header("location:" . URL . "produit/lister");
        }
    }

    public function getAllProduits()
    {
        return $this->shopManager->getProduits();
    }

    public function getAllCaracteristique()
    {
        return $this->shopManager->getCaracteristique();
    }

    public function displayPanierWidget()
    {
        echo 'IdPanier : ' . $this->shopManager->getIdPanier();
    }

    public function getAllParfums()
    {
        return $this->shopManager->getAllParfumsDB();
    }

    public function demandeInfoProduit($idProduit)
    {
        $data = $this->shopManager->demandeInfoProduitDB($idProduit);
        echo json_encode($data);
    }

    public function demandeSuppressionProduit($idProduit)
    {
        $data = $this->shopManager->deleteProduit($idProduit);
        echo json_encode($data);
    }

    // public function getIdPanier()
    // {
    //     return $this->shopManager->getIdPanier();
    // }
}
