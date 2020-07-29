<?php

class Commentaire {
    private $id;
    private $nom;
    private $commentaire;
    private $textFormat;

    public function __construct($row=null)
    {
        if ($row!=null) {
            $this->hydrate($row);
        }
    }
    public function getProfil(){
        return $this->profil;
    }

    public function hydrate($row)
    {
        $this->id=$row['id'];
        $this->fullName=$row['fullName'];
        $this->login=$row['login'];
        $this->pwd=$row['pwd'];
        $this->profil=$row['profil'];
        $this->avatar=$row['avatar'];
    }
}