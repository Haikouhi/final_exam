<?php

class Conducteur extends Db {
    
    protected $id_conducteur;
    protected $nom;
    protected $prenom;

    const TABLE_NAME = 'conducteur';

    public function __construct($nom, $prenom, $id_conducteur = null) {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setId($id_conducteur);
    }
    /**
     * Get the value of id
     */ 
    public function id()
    {
        return $this->id_conducteur;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_conducteur)
    {
        $this->id_conducteur = $id_conducteur;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function nom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        if (strlen($nom) == 0) {
            throw new Exception('Le nom ne doit pas être vide.');
        }


        $this->nom = $nom;
        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function prenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        if (strlen($prenom) == 0) {
            throw new Exception('Le prénom ne doit pas être vide.');
        }


        $this->prenom = $prenom;
        return $this;
    }

    public function nomComplet() {
        return $this->prenom() . ' ' . $this->nom();
    }

    


    /**
     * CRUD Methods
     */

    public static function findOne(int $id_conducteur) {

        $data = Db::dbFind(self::TABLE_NAME, [
            ['id', '=', $id_conducteur]
        ]);
        
        if(count($data) > 0) $data = $data[0];
        else return;

        $conducteur = new Conducteur($data['nom'], $data['prenom'], $data['id']);

        return $conducteur;

    }

    public static function findAll() {

        $datas = Db::dbFind(self::TABLE_NAME);

        $conducteur = [];

        foreach($datas as $data) {
            $conducteur[] = new Conducteur($data['nom'], $data['prenom'], $data['id']);
        }

        return $conducteur;

    }
    public function save() {

        $data = [
            "nom"       => $this->nom(),
            "prenom"    => $this->prenom(),
        ];

        if ($this->id() > 0) return $this->update();
        $nouvelId = Db::dbCreate(self::TABLE_NAME, $data);
        $this->setId($nouvelId);
        return $this;
    }

    public function update() {

        if ($this->id > 0) {
            $data = [
                "nom"       => $this->nom(),
                "prenom"    => $this->prenom(),
                "id"        => $this->id()
            ];
            Db::dbUpdate(self::TABLE_NAME, $data);
            return $this;
        }
        return;
    }

    public function delete() {

        $data = [
            'id' => $this->id(),
        ];
        
        Db::dbDelete(self::TABLE_NAME, $data);

        // On supprime aussi tous les emprunts !
        Db::dbDelete(Emprunt::TABLE_NAME, [
            'id_conducteur' => $this->id()
        ]);

        return;
    }
}