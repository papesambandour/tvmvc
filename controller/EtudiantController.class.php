<?php
    class Etudiant extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }


        public function create()
        {
            $etudiant = new EtudiantM($_GET['matE'],$_GET['prenomE'],$_GET['nomE'],$_GET['classE']);
            EtudiantM::create($etudiant);
            echo EtudiantM::lastId(); ;
        }
        public function delete()
        {
            EtudiantM::delete($_GET['idE']);
            echo 1 ;
        }
         public function show()
        {

          echo json_encode (EtudiantM::show((int)$_GET['idE'])->fetch(),JSON_PRETTY_PRINT);

        }
        public function gets()
        {

          echo json_encode (EtudiantM::gets()->fetchAll(),JSON_PRETTY_PRINT);

        }
        public function update()
        {
            $etudiant = new EtudiantM($_GET['mateEtu'],$_GET['prenomE'],$_GET['nomE'],$_GET['classE'],$_GET['idE']);
            EtudiantM::update($etudiant);
                echo 1 ;
        }


    }
?>