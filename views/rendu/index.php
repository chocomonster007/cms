<?php 

use App\Connection;
use App\Page;

$pdo = Connection::getPDO();
$pdo->exec('CREATE TABLE IF NOT EXISTS changement(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, pagename VARCHAR(250), content TEXT)');
$first = $pdo->query("SELECT * FROM changement WHERE pagename = 'perso'");
$first->setFetchMode(PDO::FETCH_CLASS, Page::class);
$datas = $first->fetch();

    if(!empty($_POST['perso'])){
        
        
        if($datas == false){
            $query = $pdo->prepare('INSERT INTO changement SET pagename = :pagename, content = :content');
            $query->setFetchMode(PDO::FETCH_CLASS, Page::class);
            $query->execute(['pagename'=>'perso', 'content' => $_POST['perso']]);
            }
        else{
            $query = $pdo->prepare('UPDATE changement SET content = :content WHERE pagename = :pagename');
            $query->setFetchMode(PDO::FETCH_CLASS, Page::class);
            $query->execute(['pagename'=>'perso', 'content' => $_POST['perso']]);
        }
        
        
    }

?>
<?php if($datas):?>
    <header> <a href="<?= $router->url('createLog')?>">Modifier la page</a></header>
    <?= $datas->content ?>
<?php else :?>

<div class="first">
<h1>Bonjour et bienvenue sur le CMS</h1>
<a href="<?= $router->url('firstLogin')?>">Commencer à modifier ma page</a>
</div>
<?php endif ?>