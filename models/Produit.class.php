<?php
class Produit
{
    private $id;
    private $nom;
    private $prix;
    private $quantite;
    //public static $panier;

    function __construct($id, $nom, $prix, $quantite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
        //self::$panier[] = $this;//l'attribut statique $panier lui-même stocke l'objet courant juste créé.
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getId()
    {
        return htmlspecialchars($this->id);
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNom()
    {
        return htmlspecialchars($this->nom);
    }

    public function getPrix()
    {
        return htmlspecialchars($this->prix);
    }
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function getQuantite()
    {
        return htmlspecialchars($this->quantite);
    }
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
        return $this;
    }
}
