
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="prout">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/perso.css" rel="stylesheet" type="text/css">
    <script src="/script/perso.js" type = "module" defer></script>
    <title><?= $title ?? 'Le CMS'?></title>
</head>
<body>
    <header>
        <a href="<?= $router->url('deconnection')?>" class="deco">Se déconnecter</a>
        <a href="<?= $router->url('rendu')?>" class="deco">Voir ma page</a>

    </header>
   <?= $content ?> 
</body>
</html>