<?php
    class Note extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }


        public function create()
        {
            $etudiant = new NoteM($_GET['valeur'],$_GET['semestre'],$_GET['annee'],$_GET['matier'],$_GET['idE']);
            NoteM::create($etudiant);
            echo 1;
        }
        public function shownoteetu()
        {
            echo json_encode(NoteM::getNoteByidEt($_GET['idEt'])->fetchAll());
        }

        public function updateSelect()
        {
            NoteM::updateSelecte($_GET['idNote'],$_GET['itemValue'],$_GET['item']);
            echo 1;
        }

    }
?>