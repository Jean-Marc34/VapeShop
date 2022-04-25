<?php
include_once "models/Produit.class.php";
include_once "models/Model.class.php";

class shopManager extends Model
{

    public function getUserInfo($email)
    {
        $sql = "SELECT * FROM utilisateur WHERE mail_utilisateur = :email";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":email" => $email]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result[0];
    }

    public function setUser($nom, $prenom, $date, $email, $password)
    {
        $sql = "INSERT INTO panier (nom_panier) VALUES ('')";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute();
        $idPanier = $this->getDB()->lastInsertId();
        $sql = "INSERT INTO utilisateur (nom_utilisateur,prenom_utilisateur,date_naissance_utilisateur,
        mail_utilisateur,password_utilisateur,id_role_utilisateur,id_panier)
        VALUES (:nom, :prenom, :date, :email, :password, 2, :id_panier)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":nom" => ucfirst(mb_strtolower($nom)),
            ":prenom" => ucfirst(mb_strtolower($prenom)), ":date" => $date,
            ":email" => mb_strtolower($email), ":password" => password_hash($password, PASSWORD_DEFAULT),
            ":id_panier" => $idPanier
        ]);
        $sql = "UPDATE panier SET nom_panier = :nom_panier  WHERE id_panier = :idPanier";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":nom_panier" => $email, ":idPanier"  => $idPanier]);
        return $result;
    }

    public function getUserEmail($email)
    {
        $sql = "SELECT mail_utilisateur FROM utilisateur WHERE mail_utilisateur = :email";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":email" => $email]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getUserPassword($email)
    {
        $sql = "SELECT password_utilisateur FROM utilisateur WHERE mail_utilisateur = :email";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":email" => $email]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function updateUserInfo($tel, $password)
    { //Si $password = "", c'est qu'il ne faut pas l'updater
        if ($password === "") {
            $sql = "UPDATE utilisateur SET tel_utilisateur = :tel WHERE mail_utilisateur = :email";
        } else {
            $sql = "UPDATE utilisateur SET tel_utilisateur = :tel, password_utilisateur = :password  WHERE mail_utilisateur = :email";
        }
        $req = $this->getDB()->prepare($sql);
        if ($password === "") {
            $result = $req->execute([":tel" => $tel, ":email" => empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]]);
        } else {
            $result = $req->execute([":tel" => $tel, ":password" => password_hash($password, PASSWORD_DEFAULT), ":email" => empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"]]);
        }
        return $result;
    }

    public function deleteCompte($id)
    {
        $sql = "SELECT id_adresse FROM posseder WHERE id_utilisateur = :utilisateur";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":utilisateur" => empty($_SESSION['userId']) ? $_COOKIE['userId'] : $_SESSION['userId']]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            $this->deleteAdresse($row->id_adresse);
        }

        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":id_utilisateur" => empty($_SESSION['userId']) ? $_COOKIE['userId'] : $_SESSION['userId']]);
        return $result;
    }

    public function setLivraisonInfo($numero, $rue, $complement, $code, $ville, $pays)
    {
        $sql = "INSERT INTO adresse (numero_adresse,rue_adresse,complement_adresse,code_postal_adresse,ville_adresse,pays_adresse,id_role_adresse)
        VALUES (:numero, :rue, :complement, :code, :ville, :pays, 2)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":numero" => $numero, ":rue" => ucfirst(mb_strtolower($rue)), ":complement" => ucfirst(mb_strtolower($complement)), ":code" => $code, ":ville" => ucfirst(mb_strtolower($ville)), ":pays" => ucfirst(mb_strtolower($pays))]);
        $idLivraison = $this->getDB()->lastInsertId();
        $sql = "INSERT INTO posseder (id_adresse,id_utilisateur) VALUES (:adresse, :utilisateur)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":adresse" => $idLivraison, ":utilisateur" => empty($_SESSION['userId']) ? $_COOKIE['userId'] : $_SESSION['userId']]);
        return $result;
    }

    public function getLivraisonInfo($email)
    {
        $sql = "SELECT adresse.id_adresse, adresse.numero_adresse, adresse.rue_adresse, adresse.complement_adresse,
        adresse.code_postal_adresse, adresse.ville_adresse, adresse.pays_adresse FROM adresse
        INNER JOIN role_adresse, utilisateur, posseder
        WHERE posseder.id_utilisateur = utilisateur.id_utilisateur AND posseder.id_adresse = adresse.id_adresse
        AND role_adresse.id_role_adresse = adresse.id_role_adresse AND role_adresse.nom_role_adresse = 'livraison' AND utilisateur.mail_utilisateur = :email";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":email" => $email]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function updateLivraisonInfo($numero, $rue, $complement, $code, $ville, $pays, $id)
    {
        $sql = "UPDATE adresse SET numero_adresse = :numero , rue_adresse = :rue , complement_adresse = :complement , code_postal_adresse = :code , ville_adresse = :ville , pays_adresse = :pays
        WHERE id_adresse = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":numero" => $numero, ":rue" => $rue, ":complement" => $complement, ":code" => $code, ":ville" => $ville, ":pays" => $pays, ":id" => $id]);
        return $result;
    }

    public function setFacturationInfo($numero, $rue, $complement, $code, $ville, $pays)
    {
        $sql = "INSERT INTO adresse (numero_adresse,rue_adresse,complement_adresse,code_postal_adresse,ville_adresse,pays_adresse,id_role_adresse)
        VALUES (:numero, :rue, :complement, :code, :ville, :pays, 1)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":numero" => $numero, ":rue" => ucfirst(mb_strtolower($rue)), ":complement" => ucfirst(mb_strtolower($complement)),
            ":code" => $code, ":ville" => ucfirst(mb_strtolower($ville)), ":pays" => ucfirst(mb_strtolower($pays))
        ]);
        $idFacturation = $this->getDB()->lastInsertId();
        $sql = "INSERT INTO posseder (id_adresse,id_utilisateur) VALUES (:adresse, :utilisateur)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":adresse" => $idFacturation, ":utilisateur" => empty($_SESSION['userId']) ? $_COOKIE['userId'] : $_SESSION['userId']]);
        return $result;
    }

    public function getFacturationInfo($email)
    {
        $sql = "SELECT adresse.id_adresse, adresse.numero_adresse, adresse.rue_adresse, adresse.complement_adresse,
        adresse.code_postal_adresse, adresse.ville_adresse, adresse.pays_adresse FROM adresse
        INNER JOIN role_adresse, utilisateur, posseder
        WHERE posseder.id_utilisateur = utilisateur.id_utilisateur AND posseder.id_adresse = adresse.id_adresse
        AND role_adresse.id_role_adresse = adresse.id_role_adresse AND role_adresse.nom_role_adresse = 'facturation'
        AND utilisateur.mail_utilisateur = :email";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":email" => $email]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function updateFacturationInfo($numero, $rue, $complement, $code, $ville, $pays, $id)
    {
        $sql = "UPDATE adresse SET numero_adresse = :numero , rue_adresse = :rue , complement_adresse = :complement ,
         code_postal_adresse = :code , ville_adresse = :ville , pays_adresse = :pays
        WHERE id_adresse = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":numero" => $numero, ":rue" => $rue, ":complement" => $complement, ":code" => $code,
            ":ville" => $ville, ":pays" => $pays, ":id" => $id
        ]);
        return $result;
    }

    public function deleteAdresse($id)
    {
        $sql = "DELETE FROM posseder WHERE id_adresse = :adresse AND id_utilisateur = :utilisateur";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":adresse" => $id,
            ":utilisateur" => empty($_SESSION['userId']) ? $_COOKIE['userId'] : $_SESSION['userId']
        ]);

        $sql = "DELETE FROM adresse WHERE id_adresse = :id_adresse";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":id_adresse" => $id]);
        return $result;
    }

    public function isAdmin($id)
    {
        $sql = "SELECT nom_role_utilisateur FROM role_utilisateur
        INNER JOIN utilisateur
        WHERE role_utilisateur.id_role_utilisateur = utilisateur.id_role_utilisateur
        AND utilisateur.id_utilisateur = :id AND nom_role_utilisateur = 'admin' ";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":id" => $id]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function setProduit($parfum, $prix, $quantite, $image)
    {
        $sql = "INSERT INTO produit (parfum_produit, prix_produit ,quantite_produit, nom_image_produit, chemin_image_produit, id_caracteristique)
        VALUES (:parfum, :prix, :quantite, :image, :chemin, 1)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":parfum" => ucfirst(mb_strtolower($parfum)), ":prix" => $prix, ":quantite" => $quantite, ":image" => $image, ":chemin" => 'public/images/' . $image]);
        return $result;
    }

    public function getProduits()
    {
        $sql = "SELECT * FROM produit";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getCaracteristique()
    {
        $sql = "SELECT * FROM caracteristique";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result[0];
    }
    public function demandeInfoProduitDB($idProduit)
    {
        $sql = "SELECT * FROM produit WHERE id_produit = :id_produit";
        $req = $this->getDB()->prepare($sql);
        $req->execute([":id_produit" => $idProduit]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAllParfumsDB()
    {
        $sql = "SELECT parfum_produit FROM produit";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function updateProduit($id, $parfum, $prix, $quantite, $image)
    {
        var_dump($parfum);
        $sql = "UPDATE produit SET parfum_produit = :parfum , prix_produit = :prix , quantite_produit = :quantite , nom_image_produit = :image , chemin_image_produit = :chemin WHERE id_produit = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":parfum" => ucfirst(mb_strtolower($parfum)), ":prix" => $prix, ":quantite" => $quantite, ":image" => $image, ":chemin" => 'public/images/' . $image, ":id" => $id]);
        return $result;
    }

    public function updateProduitSansImage($id, $parfum, $prix, $quantite)
    {
        $sql = "UPDATE produit SET parfum_produit = :parfum , prix_produit = :prix , quantite_produit = :quantite  WHERE id_produit = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":parfum" => ucfirst(mb_strtolower($parfum)), ":prix" => $prix, ":quantite" => $quantite, ":id" => $id]);
        return $result;
    }

    public function deleteProduit($id)
    {
        $sql = "DELETE FROM produit WHERE id_produit = :id_produit";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([":id_produit" => $id]);
        return $result;
    }



    /*
        Le code suivant pourrait servir pour la gestion du panier.
        A voir s'il n'est pas mieux de le gérer par session.
    */


    // private $panier;
    // private $idPanier;



    // public function loadingPanier()
    // {
    //     if (isset($_SESSION["user"]) || isset($_COOKIE['user'])) {
    //         //chercher id panier de l'utilisateur et l'affecter à $this->idPanier
    //         $mailUser = empty($_SESSION["user"]) ? $_COOKIE["user"] : $_SESSION["user"];
    //         $sql = "SELECT id_panier FROM utilisateur WHERE mail_utilisateur = :email";
    //         $req = $this->getDB()->prepare($sql);
    //         $req->execute([":email" => $mailUser]);
    //         $result = $req->fetchAll(PDO::FETCH_OBJ);
    //         $this->setIdPanier($result[0]->id_panier);
    //     } else {
    //         $this->setIdPanier(0);
    //     }
    // }



    // public function setIdPanier($idPanier)
    // {
    //     $this->idPanier = $idPanier;
    //     return $this;
    // }

    // public function getIdPanier()
    // {
    //     return $this->idPanier;
    // }





    // public function ajouterProduit($produit)
    // {
    //     $this->panier[] = $produit;
    // }

    // public function setPanier($panier)
    // {
    //     $this->panier = $panier;
    //     return $this;
    // }
    // public function getPanier()
    // {
    //     return $this->panier;
    // }



    // public function connexionOK()
    // {
    //     $_SESSION["user"] = $_POST['email'];
    //     if (isset($_POST['remember'])) {
    //         setcookie('user', $_POST['email'], time() + 31556926); //temps actuel + 1 an;
    //     }
    // }





}
