<?php
class Model
{
    protected static $db ;
    public function __construct()
    {
        $this->db = $this->getConnexion();
    }
    private static function getConnexion()
    {
        try{
            $host = DataBaseConfig:: params()[0];
            $user = DataBaseConfig:: params()[1];
            $password = DataBaseConfig:: params()[2];
            $database = DataBaseConfig:: params()[3];
            $dsn = "mysql:host=$host; dbname=$database";
            if(self::$db !== null)
            {
                return self::$db ;
            }
          return  self::$db = new PDO ($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }catch (PDOException $ex)
        {
            $erreur_base = $ex->getMessage();
            if(substr($erreur_base,0,8)=="SQLSTATE")
                echo "Hooo, database not create ";
            else
                 die('Erreur : '.$ex->getMessage());
        }

    }
    protected static function query($query,$data = null)
    {
        if($data == null)
        {
           return self::$db->query($query);
        }
        else
        {
             $req= self::$db->prepare($query);
             $req->execute($data);
            return $req;

        }
    }
    public static function lastId()
    {
       return self::$db->lastInsertId();
    }
}