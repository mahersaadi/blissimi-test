<?php
namespace Controllers;
require_once ('libraries/autoload.php');

class Article
{
    protected $model;
    public function __construct(){

        $this->model= new \Models\Article();

    }
   public function index(){

       $articles= $this->model->findAll("created_at DESC");

       /**
        * 3. Affichage
        */
       $pageTitle = "Accueil";
       \Renderer::render('articles/index',compact('pageTitle','articles'));
   }
    public function show(){

        $commentModel= new \Models\Commentaire();
        $article_id = null;

// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

// On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

// On fouille le résultat pour en extraire les données réelles de l'article
        $article = $this->model->find($article_id);

        /**
         * 4. Récupération des commentaires de l'article en question
         * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
         */

        $commentaires = $commentModel->findAllWithArticle($article_id);

        /**
         * 5. On affiche
         */
        $pageTitle = $article['title'];
        \Renderer::render('articles/show',compact('pageTitle','article','commentaires','article_id'));

    }
    public function delete(){

        /**
         * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
         *
         * Il va donc falloir bien s'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
         * Ensuite, on va pouvoir effectivement supprimer l'article et rediriger vers la page d'accueil
         */

        /**
         * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification que l'article existe bel et bien
         */

        $article=$this->model->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        /**
         * 4. Réelle suppression de l'article
         */
        $this->model->delete($id);

        /**
         * 5. Redirection vers la page d'accueil
         */
        \Http::redirect('index.php');
    }
}
