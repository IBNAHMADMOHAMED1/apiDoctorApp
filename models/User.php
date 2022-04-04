<?php
class User extends Model
{

    public function __construct()
    {
        // die(var_dump(5));
        // Nous définissons la table par défaut de ce modèle
        $this->table = "users";

        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    /**
     * Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */
    public function findId(string $slug)
    {
        // die(var_dump($slug));
        $sql = "SELECT * FROM " . $this->table . " WHERE user_id ='" . $slug . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function AddOne($data)
    {

        // die(var_dump($data->category_id)); 
        $query = 'INSERT INTO ' . $this->table . ' SET title = :username, password = :password ';
        $stmt = $this->_connexion->prepare($query);
        //  ext
        // bind prams 
        $stmt->bindParam(':username', $data->username);
        $stmt->bindParam(':password', $data->password);
        if ($stmt->execute()) {
            return 'ok';
        }
    }
    public function Update($data, $id)
    {
        $query = "UPDATE  $this->table 
    SET username = :username, password = :password
    WHERE id = $id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':username', $data->username);
        $stmt->bindParam(':password', $data->password);
      

        // Execute query
        if ($stmt->execute()) {
            return true;
            // die(var_dump('yes'));
        }
    }
    public function Delete($id)
    {
        $query = "DELETE FROM  $this->table   WHERE id = $id";

        $stmt = $this->_connexion->prepare($query);
        if ($stmt->execute()) {
            return true;
        }
    }
}
