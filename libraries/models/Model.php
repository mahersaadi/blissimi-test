<?php
namespace Models;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct(){
        $this->pdo= \Database::getPdo();
    }
    /**
     * retourne la liste des articles
     */
    public function findAll ($order="") {
        $sql="SELECT * FROM {$this->table}";
        if($order){
            $sql .= " ORDER BY ". $order;
        }

        $resultats = $this->pdo->query($sql);
        $articles = $resultats->fetchAll();
        return $articles;
    }

    /**
     * retourne un article
     */

    public function find($id) {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();
        return $item;
    }
    /**
     * supprime un commentaire
     * @param int $id
     * @return void
     */
    public function delete($id){

        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}
