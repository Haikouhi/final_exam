<?php

class Divers extends Db {


    // Afficher le nombre de conducteur. 
    public static function nombreConducteurs() {
        $req = 'SELECT COUNT(*)
                FROM conducteur';

        return Db::dbQuery($req);
    }

    //  Afficher le nombre de vehicule. 
    public static function nombreVehicules() {
        $req = 'SELECT COUNT(*)
                FROM vehicule';

        return Db::dbQuery($req);
    }

    //  Afficher le nombre d’association.
    public static function nombreAssociations() {
        $req = 'SELECT COUNT(*)
                FROM association_vehicule_conducteur';

        return Db::dbQuery($req);
    }

   // Afficher les vehicules n’ayant pas de conducteur 
    public static function vehiculesSansConducteur() {
        $req = 'SELECT *
                FROM vehicule
                LEFT JOIN association_vehicule_conducteur ON association_vehicule_conducteur.id_vehicule = vehicule.id
                WHERE id_conducteur IS NULL';

        return Db::dbQuery($req);
    }

    //  Afficher les conducteurs n’ayant pas de vehicule 
    public static function conducteursSansVehicule() {
        $req = 'SELECT *
                FROM conducteur
                LEFT JOIN association_vehicule_conducteur ON association_vehicule_conducteur.id_conducteur = conducteur.id
                WHERE id_vehicule IS NULL';

        return Db::dbQuery($req);
    }

    // Afficher les vehicules conduit par « Philippe Pandre » 
    public static function vehiculesConduitParPhilippePandre() {
        $req = 'SELECT marque, modele, couleur, immatriculation
                FROM vehicule
                INNER JOIN association_vehicule_conducteur ON association_vehicule_conducteur.id_vehicule = vehicule.id
                INNER JOIN conducteur ON association_vehicule_conducteur.id_conducteur = conducteur.id
                WHERE nom = "Pandre" AND prenom = "Philippe"';

        return Db::dbQuery($req);
    }

    //  Afficher tous les conducteurs (meme ceux qui n'ont pas de correspondance) ainsi que les vehicules 
    public static function tousLesConducteursPlusVehicules() {
        $req = 'SELECT *
                FROM conducteur
                LEFT JOIN association_vehicule_conducteur ON conducteur.id = association_vehicule_conducteur.id_conducteur
                LEFT JOIN vehicule ON vehicule.id = association_vehicule_conducteur.id_vehicule';

        return Db::dbQuery($req);
    }

    //  Afficher les conducteurs et tous les vehicules (meme ceux qui n'ont pas de correspondance)
    public static function tousLesConducteursEtVehicules() {
        $req = 'SELECT *
                FROM vehicule
                LEFT JOIN association_vehicule_conducteur ON vehicule.id = association_vehicule_conducteur.id_vehicule
                LEFT JOIN conducteur ON conducteur.id = association_vehicule_conducteur.id_conducteur';

        return Db::dbQuery($req);
    }


    // Afficher tous les conducteurs et tous les vehicules, peut importe les correspondances. 
    // Je n'ai pas compris cette requete :(


}
