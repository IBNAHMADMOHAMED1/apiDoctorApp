<?php
class Job extends Model{

    public function __construct()
    {
        // die(var_dump(5));
        // Nous définissons la table par défaut de ce modèle
        $this->table = "jobs";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }
    /**
     * Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */
    

}