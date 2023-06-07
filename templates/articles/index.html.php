<h1>Nos Produits</h1>

<?php foreach ($articles as $article) : ?>
    <h2><?= $article['title'] ?></h2>
    <small>Publié le <?= $article['created_at'] ?></small>
    <p><?= $article['introduction'] ?></p>
    <a href="index.php?controller=article&task=show&id=<?= $article['id'] ?>">Voir le détail</a>
<?php endforeach ?>
