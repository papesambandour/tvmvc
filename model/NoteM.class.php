<?php
/**
 * Created by PhpStorm.
 * User: PapeSamba
 * Date: 07/05/2018
 * Time: 10:22
 */
class  NoteM extends Model {
    private $id ;
    private $valeur ;
    private $semestre ;
    private $annee ;
    private $matier ;
    private $idEtudiant ;

    /**
     * NoteM constructor.
     * @param $id
     * @param $valeur
     * @param $semestre
     * @param $annee
     * @param $matier
     * @param $idEtudiant
     */
    public function __construct( $valeur = null, $semestre = null, $annee = null, $matier =null, $idEtudiant=null,$id = null)
    {
        $this->id = $id;
        $this->valeur = $valeur;
        $this->semestre = $semestre;
        $this->annee = $annee;
        $this->matier = $matier;
        $this->idEtudiant = $idEtudiant;
    }

    public static function updateSelecte($idNote,$value,$item)
    {

        $query = "UPDATE note set $item= ? WHERE id = ?";
        return self::query($query,[$value,$idNote]);

    }
    public static function getNoteByidEt($idE)
    {
        $query = "SELECT * FROM note WHERE idEt = ?";
        return self::query($query,[$idE]);
    }
    public static function gets()
    {
        $query = "SELECT * FROM note";
       return self::query($query);
    }
    public static function show($id)
    {
        $query = "SELECT * FROM note where id = ?";
       return self::query($query,[$id])->fetch();
    }
    public static function create(NoteM $noteM)
    {
        $query = "INSERT INTO note SET valeur = ? ,annee= ? , semestre  =? , matier = ? , idEt = ?";
       return self::query($query,[$noteM->getValeur(),$noteM->getAnnee(),$noteM->getSemestre(),$noteM->getMatier(),$noteM->getIdEtudiant()]);
    }
    public static function update(NoteM $noteM)
    {
        $query = "UPDATE note SET valeur = ? ,annee= ? , semestre  =? , matier = ? , idEt = ? where id = ?";
        return self::query($query,[$noteM->getValeur(),$noteM->getAnnee(),$noteM->getSemestre(),$noteM->getMatier(),$noteM->getIdEtudiant(),$noteM->getId()]);
    }
    public static function delete($id)
    {
        $query = "DELETE FROM note WHERE id = ?";
       return self::query($query,[$id]);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * @param mixed $valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }

    /**
     * @return mixed
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * @param mixed $semestre
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    }

    /**
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $annee
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    /**
     * @return mixed
     */
    public function getMatier()
    {
        return $this->matier;
    }

    /**
     * @param mixed $matier
     */
    public function setMatier($matier)
    {
        $this->matier = $matier;
    }

    /**
     * @return mixed
     */
    public function getIdEtudiant()
    {
        return $this->idEtudiant;
    }

    /**
     * @param mixed $idEtudiant
     */
    public function setIdEtudiant($idEtudiant)
    {
        $this->idEtudiant = $idEtudiant;
    }


}