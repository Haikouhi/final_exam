<?php

class Vehicule extends Db {

    protected $id_vehicule;
    protected $marque;
    protected $modele;
    protected $couleur;
    protected $immatriculation;

    const TABLE_NAME = 'vehicule';

    public function __construct($marque, $modele, $couleur, $immatriculation, $id_vehicule = null) {
        $this->setMarque($marque);
        $this->setModele($modele);
        $this->setCouleur($couleur);
        $this->setImmatriculation($immatriculation);
        $this->setId($id_vehicule);
    }

    /**
     * Get the value of id
     */ 
    public function id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_vehicule)
    {
        $this->id = $id_vehicule;

        return $this;
    }

    /**
     * Get the value of marque
     */ 
    public function marque()
    {
        return $this->marque;
    }

    /**
     * Set the value of marque
     *
     * @return  self
     */ 
    public function setMarque(string $marque)
    {

        if (strlen($marque) == 0) {
            throw new Exception('La marque doit être fournie.');
        }

        $this->marque = $marque;
        return $this;
    }

    /**
     * Get the value of modele
     */ 
    public function modele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */ 
    public function setModele($modele)
    {
        if (strlen($modele) == 0) {
            throw new Exception('Le modèle ne doit pas être nul.');
        }


        $this->modele = $modele;
        return $this;
    }

    
    /**
     * Get the value of couleur
     */ 
    public function couleur()
    {
        return $this->couleur;
    }

    /**
     * Set the value of couleur
     *
     * @return  self
     */ 
    public function setCouleur($couleur)
    {
        if (strlen($couleur) == 0) {
            throw new Exception('La couleur ne doit pas être nul.');
        }


        $this->couleur = $couleur;
        return $this;
    }


    
    /**
     * Get the value of immatriculation
     */ 
    public function immatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set the value of immatriculation
     *
     * @return  self
     */ 
    public function setImmatriculation($immatriculation)
    {
        if (strlen($immatriculation) == 0) {
            throw new Exception('L\'immatriculation ne doit pas être nul.');
        }


        $this->immatriculation = $immatriculation;
        return $this;
    }


public function nomComplet() {
        return $this->marque() . ' ' . $this->modele() . ' ' . $this->couleur() . ' ' . $this->immatriculation();
    }





    /**
     * CRUD Methods
     */

    public static function findOne(int $id_vehicule) {

        $data = Db::dbFind(self::TABLE_NAME, [
            ['id', '=', $id_vehicule]
        ]);

        if(count($data) > 0) $data = $data[0];
        else return;


        $vehicule = new Vehicule($data['marque'], $data['modele'], $data['couleur'], $date['immatriculation'], $data['id']);

        return $vehicule;

    }

    public static function findAll() {

        $datas = Db::dbFind(self::TABLE_NAME);

        $vehicules = [];

        foreach($datas as $data) {
            $vehicules[] = new Vehicule($data['marque'], $data['modele'], $data['couleur'], $date['immatriculation'], $data['id']);
        }

        return $vehicules;

    }
    public function save() {

        $data = [
            "marque"              => $this->marque(),
            "modele"              => $this->modele(),
            "couleur"             => $this->couleur(),
            "immatriculation"     => $this->immatriculation()
            
        ];

        if ($this->id() > 0) return $this->update();
        $nouvelId = Db::dbCreate(self::TABLE_NAME, $data);
        $this->setId($nouvelId);
        return $this;
    }

    public function update() {

        if ($this->id > 0) {
            $data = [
            "marque"              => $this->marque(),
            "modele"              => $this->modele(),
            "couleur"             => $this->couleur(),
            "immatriculation"     => $this->immatriculation(),
            "id"                  => $this->id()
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
        Db::dbDelete(Both::TABLE_NAME, [
            'id_vehicule' => $this->id()
        ]);

        return;
    }

}