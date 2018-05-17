<?php
    class Accueil extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {

            $etudiants = EtudiantM::gets();
            return $this->view->load('etudiant/index',['etudiants'=>$etudiants]);
        }

    }
?>