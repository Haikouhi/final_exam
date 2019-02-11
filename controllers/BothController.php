
<?php

class BothController {

    public function index() {
        $both = Both::findAll();
        view('boths.index', compact('boths'));

    }

    public function add() {

        $vehicules = Vehicule::findAll();
        $conducteurs = Conducteur::findAll();
        view('boths.add', compact('vehicules', 'conducteurs'));

    }

    public function save() {

        $both = new Both($_POST['id_vehicule'], $_POST['id_conducteur'], $_POST['id']);
        $both->save();

        Header('Location: '. url('boths'));
        exit();

    }

    public function delete() {

    }

}