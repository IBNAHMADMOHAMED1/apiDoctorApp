<?php 

class Pasien extends Model{

    public function __construct()
    {
        $this->table = 'pasien';
        
        $this->getConnection();
    }
    /**
     * Retourne un article en fonction de son slug

     */

    public function findId(string $slug){
        $sql = "SELECT * FROM ".$this->table." WHERE `id`='".$slug."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data,$Reference){
        // die(var_dump($data->Nom));
        
        $query = 'INSERT INTO ' . $this->table . ' SET Reference = :Reference  , Nom = :Nom, Prenom = :Prenom , Email = :Email, Age = :Age , Tele = :Tele';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':Reference', $Reference);
        $stmt->bindParam(':Nom', $data->Nom);
        $stmt->bindParam(':Prenom', $data->Prenom);
        $stmt->bindParam(':Email', $data->Email);
        $stmt->bindParam(':Age', $data->Age);
        $stmt->bindParam(':Tele', $data->Tele);

        if(  $stmt->execute())
        {
            return true;

        }
    }

    public function find ($Reference)
    {
        $sql = "SELECT * FROM ".$this->table . " WHERE `Reference`='". $Reference."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
       if (empty( $query->fetchAll(PDO::FETCH_ASSOC)))
       {
           return false;
       }
       else
       {
           return true;
       }
    }
}