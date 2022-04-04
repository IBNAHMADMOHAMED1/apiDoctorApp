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


    public function create($data)
    {
        // die(var_dump($data->Nom));

        $query = 'INSERT INTO ' . $this->table . ' SET DateConsult = :DateConsult, Horaire = :Horaire  , Reference = :Reference, sujet= :sujet';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':DateConsult', $data->DateConsult);
        $stmt->bindParam(':Horaire', $data->Horaire);
        $stmt->bindParam(':Reference', $data->Reference);
        $stmt->bindParam(':sujet', $data->sujet);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function find($DateConsult)
    {
        $sql = "SELECT Horaire FROM " . $this->table . " WHERE `DateConsult`='" . $DateConsult . "'";
        $query = $this->_connexion->prepare($sql);

        if ($query->execute()) {
            return  $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    public function update($data, $id)
    {
        $query = 'UPDATE ' . $this->table . ' SET DateConsult = :DateConsult, Horaire = :Horaire  , Reference = :Reference WHERE id = :id';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':DateConsult', $data->DateConsult);
        $stmt->bindParam(':Horaire', $data->Horaire);
        $stmt->bindParam(':Reference', $data->Reference);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function get($Reference)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE Reference = :Reference ORDER BY DateConsult DESC';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':Reference', $Reference);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
