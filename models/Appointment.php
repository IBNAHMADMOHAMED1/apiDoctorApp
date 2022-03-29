<?php 

class Appointment extends Model
{
    public function __construct()
    {
        $this->table = 'rendezvous';
        
        $this->getConnection();
    }
    /**
     * Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */


    public function create($data){
        // die(var_dump($data->Nom));
        
        $query = 'INSERT INTO ' . $this->table . ' SET DateConsult = :DateConsult, Horaire = :Horaire  , Reference = :Reference';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':DateConsult', $data->DateConsult);
        $stmt->bindParam(':Horaire', $data->Horaire);
        $stmt->bindParam(':Reference', $data->Reference);
    
        if(  $stmt->execute())
        {
            return true;

        }else {
            return false;
        }
    }

    public function find ($id)
    {
        $sql = "SELECT * FROM ".$this->table . " WHERE `id`='". $id."'";
        $query = $this->_connexion->prepare($sql);
       
      if ($query->execute()) 
      {
              return  $query->fetch(PDO::FETCH_ASSOC);
      }
        else
        {
            return false;
        }
      
       
    }
    public function update($data,$id)
    {
        $query = 'UPDATE ' . $this->table . ' SET DateConsult = :DateConsult, Horaire = :Horaire  , Reference = :Reference WHERE id = :id';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':DateConsult', $data->DateConsult);
        $stmt->bindParam(':Horaire', $data->Horaire);
        $stmt->bindParam(':Reference', $data->Reference);
        $stmt->bindParam(':id', $id);
        if(  $stmt->execute())
        {
            return true;

        }else {
            return false;
        }
    }
    public function delete($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id', $id);
        if(  $stmt->execute())
        {
            return true;

        }else {
            return false;
        }
    }
}