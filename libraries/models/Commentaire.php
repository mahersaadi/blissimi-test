<?php
namespace Models;
class Commentaire extends Model
{

    protected  $table='comments';

    /**
     * retourne tout les commentaires d'un article
     * @param int $article_id
     * @return array
     */
    public function findAllWithArticle($article_id){

        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;

    }

    /**
     * enregistre un commentaire
     * @param string $author
     * @param string $content
     * @param int $article_id
     * @return void
     */
     public function insert( $author,  $content,  $article_id){

        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));

    }

}
