<?php

use App\Connection;
use App\Admin\User;
use App\HTML\Form;

$router->layout = "/layout/perso";
$error = false;
$creation =false;



try{
    $pdo = Connection::getPDO();
    $pdo->exec('CREATE TABLE IF NOT EXISTS users (id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, username VARCHAR(255),
    mail VARCHAR(255), password TEXT)');
    $pdo->exec('CREATE TABLE IF NOT EXISTS changement (id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, pagename VARCHAR(255),
    content TEXT)');
    $query = $pdo->query('SELECT * FROM users');
    $query->setFetchMode(PDO::FETCH_CLASS, User::class);
    $datas = $query->fetch();



}
catch(\PDOException $e){
    $error = true;
    dd($e->getMessage());

}
if(isset($_GET['creation'])){
    $creation =true;
}

?>
<main>
   
<div class="dos">
    <?php if($datas && !$creation) :?>
        <h2>Connection à votre compte</h2>
        <?php if(isset($_GET['failConnection'])) :?>
            <h3>Identifiant ou mot de passe incorrect</h3>
        <?php endif ?>
        <form action='<?= $router->url('createLog') ?>' method='post'>
        <?= Form::input('username','Nom d\'utilisateur', true) ?>
        <?= Form::input('password','Mot de passe', true) ?>
        <button type="submit">Se connecter</button>
        <a href="<?= $router->url('firstLogin').'?creation=true'?>">Créer un compte</button>

    </form>
<?php else :?>
    <h2>Création de votre compte</h2>
    <form action='<?= $router->url('createLog') ?>' method='post'>
        <?= Form::input('mailNew','Adresse mail', true) ?>
        <?= Form::input('usernameNew','Nom d\'utilisateur', true) ?>
        <?= Form::input('passwordNew','Mot de passe', true) ?>
        <button type="submit">Créer son compte  </button>
    </form>

<?php endif ?>
</div>
</main>