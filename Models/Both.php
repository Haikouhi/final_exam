<?php

class Both extends Db {

    protected $id_association;
    protected $id_vehicule;
    protected $id_conducteur;

    const TABLE_NAME = 'association_vehicule_conducteur';

    public function __construct($id_vehicule, $id_conducteur, $id_association = null) {
        $this->setIdVehicule($id_vehicule);
        $this->setIdConducteur($id_conducteur);
        $this->setId($id_association);
    }
    /**
     * Get the value of id
     */ 
    public function id_association()
    {
        return $this->id_association;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_association)
    {
        $this->id_association = $id_association;

        return $this;
    }

    /**
     * Get the value of id_vehicule
     */ 
    public function idVehicule()
    {
        return $this->id_vehicule;
    }

    /**
     * Set the value of id_vehicule
     *
     * @return  self
     */ 
    public function setIdVehicule($id_vehicule)
    {
        $this->id_vehicule = $id_vehicule;

        return $this;
    }

    /**
     * Get the value of id_conducteur
     */ 
    public function idConducteur()
    {
        return $this->id_conducteur;
    }

    /**
     * Set the value of id_conducteur
     *
     * @return  self
     */ 
    public function setIdConducteur($id_conducteur)
    {
        $this->id_conducteur = $id_conducteur;

        return $this;
    }

    public static function findOne(int $id_association) {

        $data = Db::dbFind(self::TABLE_NAME, [
            ['id' => $id_association]
        ]);

        if(count($data) > 0) $data = $data[0];
        else return;

        $both = new Both($data['id_vehicule'], $data['id_conducteur'], $data['id_association']);

        return $both;

    }

    public static function findAll() {

        $datas = Db::dbFind(self::TABLE_NAME);

        $both = [];

        foreach($datas as $data) {
            $both[] = new Both($data['id_vehicule'], $data['id_conducteur'], $data['id_association']);
        }

        return $both;

    }
    public function save() {

        $data = [
            "id_vehicule"     => $this->idVehicule(),
            "id_conducteur"    => $this->idConducteur(),
        ];

        if ($this->id() > 0) return $this->update();
        $nouvelId = Db::dbCreate(self::TABLE_NAME, $data);
        $this->setId($nouvelId);
        return $this;
    }

    public function update() {

        if ($this->id_association > 0) {
            $data = [
                "id_vehicule"           => $this->idVehicule(),
                "id_conducteur"         => $this->idConducteur(),
                "id_association"        => $this->id()
            ];
            Db::dbUpdate(self::TABLE_NAME, $data);
            return $this;
        }
        return;
    }

    public function delete() {

        $data = [
            'id' => $this->id_association(),
        ];
        
        Db::dbDelete(self::TABLE_NAME, $data);

        // On supprime aussi les both !
        Db::dbDelete(Both::TABLE_NAME, [
            'id_vehicule' => $this->id_association()
        ]);

        return;
    }

    public function vehicule() {

        return Vehicule::findOne($this->idVehicule());
    }

    public function conducteur() {
        return Conducteur::findOne($this->idConducteur());
    }
}