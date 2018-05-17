<?php
/**
 * Created by PhpStorm.
 * User: PapeSamba
 * Date: 07/05/2018
 * Time: 10:22
 */
class  EtudiantM extends Model {
    private $id ;
    private $mat ;
    private $prenom ;
    private $nom ;
    private $class ;

    /**
     * EtudiantM constructor.
     * @param $mat
     * @param $prenom
     * @param $nom
     * @param $class
     */
    public function __construct($mat =null, $prenom =null, $nom = null, $class = null,$id = null)
    {
        $this->mat = $mat;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->class = $class;
        $this->id = $id;
    }
    public static function gets()
    {
        $query = "SELECT * FROM etudiant ORDER BY prenom asc";
       return self::query($query);
    }
    public static function show($id)
    {
        $query = "SELECT * FROM etudiant where id = ?";
       return self::query($query,[$id]);
    }
    public static function create(EtudiantM $etudiantM)
    {
        $query = "INSERT INTO etudiant SET mat = ? ,nom= ? , prenom  =? , class = ?";
       return self::query($query,[$etudiantM->getMat(),$etudiantM->getNom(),$etudiantM->getPrenom(), $etudiantM->getClass()]);
    }
    public static function update(EtudiantM $etudiantM)
    {
        $query = "update etudiant SET mat = ? ,nom= ? , prenom  =? , class = ? WHERE id = ?";
       return self::query($query,[$etudiantM->getMat(),$etudiantM->getNom(),$etudiantM->getPrenom(), $etudiantM->getClass(),$etudiantM->getId()]);
    }
    public static function delete($id)
    {
        $query = "DELETE FROM etudiant WHERE id = ?";
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
    public function getMat()
    {
        return $this->mat;
    }

    /**
     * @param mixed $mat
     */
    public function setMat($mat)
    {
        $this->mat = $mat;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

}