<?php
session_start();
use App\Connection;
use App\Admin\User;
use App\Page;
$router->layout = "/layout/perso";

$pdo = Connection::getPDO();
$querys = $pdo->query('SELECT * FROM changement');
$querys->setFetchMode(PDO::FETCH_CLASS, Page::class);
$data = $querys->fetch();



if(isset($_POST['usernameNew'])){
    
    $pass = password_hash($_POST['passwordNew'],PASSWORD_BCRYPT);
    $query = $pdo->prepare("INSERT INTO users SET username = :username, password = :password, mail = :mail");
    $query->setFetchMode(PDO::FETCH_CLASS, User::class);
    $datas = $query->execute(['username'=>$_POST['usernameNew'], 'password'=>$pass, 'mail' => $_POST['mailNew']]);
    $id = $pdo->lastInsertId();
    $_SESSION['id']=$id;

   
}

elseif(isset($_POST['username'])){
    
    $query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $query->setFetchMode(PDO::FETCH_CLASS, User::class);
    $query->execute(['username'=>$_POST['username']]);
    $user = $query->fetch();
    
    if(!$user || !password_verify($_POST['password'], $user->password)){
        header('Location: '.$router->url('firstLogin').'?failConnection=1');
        exit();
    }
    
    $id = $user->id;
    $_SESSION['id']=$id;

    
}
elseif(isset($_SESSION['id'])){
    $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $query->setFetchMode(PDO::FETCH_CLASS, User::class);
    $query->execute(['id'=>$_SESSION['id']]);
    $user = $query->fetch();

}
else{
    header('Location: '. $router->url('firstLogin'));
    exit();
}




?>

<section id="widgets">
    <div class="widgets">
        <div class="widget" data-name='h3' data-create='input' draggable = "true">
            <img src="">
            <h4>Titre</h4>
        </div>
        <div class="widget" data-name='p' data-create="textarea" draggable = "true">
            <img src="">
            <h4>Texte</h4>
        </div>
        <div class="widget" draggable = "true">
            <img src="">
            <h4>Texte</h4>
        </div>
        <div class="widget" draggable = "true">
            <img src="">
            <h4>Texte</h4>
        </div>
        <div class="widget">
            <img src="">
            <h4>Texte</h4>
        </div>
    </div>
    <button id='sauvegarde'>Sauvegarder</button>
</section>
<section id="css" class="none">
    <div class="cssBis" id="cssWidget"></div>
</section>
<section id="perso">
    <?php if($data):?>
        <?php $affiche = explode(">",$data->content,2)[1]; ?>
        <?= $affiche ?>
        
    <?php endif ?>
</section>

<template id="t-text">
    <img src="/img/widget.png" alt="" id='imgWidget'>
    <div class="t-texte">
        <label for="color">Couleur</label>
        <input type="text" id='color' value="#000000">
        <label for="fontSize">Taille de police</label>
        <input type="number" id='fontSize' value="1" data-unit="em">
        <select data-pour= 'fontSize'>
            <option value="em">Em</option>
            <option value="px">Px</option>
            
        </select>
        <label for="padding">Marge interne</label>
        <input type="number" id='paddingTop' data-unit="px">
        <input type="number" id='paddingRight' data-unit="px">
        <input type="number" id='paddingBottom' data-unit="px">
        <input type="number" id='paddingLeft' data-unit="px">


    </div>
</template>

<template id="loading">
    <div class="sauver"><p>Sauvegarde réussie !</p></div>
</template>