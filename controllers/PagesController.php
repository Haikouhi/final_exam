<?php

class PagesController {

    public function home() {

        view('pages.home');

    }


    public function divers() {

        echo "<hr>Afficher le nombre de conducteurs.";
        var_dump(Divers::nombreConducteurs());

        echo "<hr>Afficher le nombre de vehicule.";
        var_dump(Divers::nombreVehicules());

        echo "<hr>Afficher le nombre d’association.";
        var_dump(Divers::nombreAssociations());

        echo "<hr>Afficher les vehicules n’ayant pas de conducteur.";
        var_dump(Divers::vehiculesSansConducteur());

        echo "<hr>Afficher les conducteurs n’ayant pas de vehicule.";
        var_dump(Divers::conducteursSansVehicule());

        echo "<hr>Afficher les vehicules conduit par « Philippe Pandre » ";
        var_dump(Divers::vehiculesConduitParPhilippePandre());

        echo "<hr>Afficher tous les conducteurs (meme ceux qui n'ont pas de correspondance) ainsi que les vehicules.";
        var_dump(Divers::tousLesConducteursPlusVehicules());

        echo "<hr>Afficher les conducteurs et tous les vehicules (meme ceux qui n'ont pas de correspondance) ";
        var_dump(Divers::tousLesConducteursEtVehicules());

        // echo "<hr>Afficher tous les conducteurs et tous les vehicules, peut importe les correspondances. ";
        // var_dump(Divers::tousLesOuvragesPlusAbonnes());

    }








}





