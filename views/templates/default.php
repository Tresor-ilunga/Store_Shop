<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/src/css/main.css">
    <style>
        .container{
            padding-top: 70px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php echo $content ?>
    </div>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
                <a class="navbar-brand" href="#">Store Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL.SEPARATOR."accueil" ?>">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL.SEPARATOR."produit"?>">Produit</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Catégories</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php
                                    foreach($category as $key => $value){
                                        echo '<li><a class="dropdown-item" href="'.BASE_URL.SEPARATOR."category".SEPARATOR.$value['id'].'">'.$value['name'].'</a></li>';
                                    }                 
                                ?>
                            </ul>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL.SEPARATOR."contact"?>">Contact</a>
                            </li>
                        </li>
                    </ul>
                    <a href="<?php echo BASE_URL.SEPARATOR."panier"?>" class="btn btn-outline-success my-2 my-sm-0 me-2">Panier</a>
                    <?php if(!isset($_SESSION["customer"])): ?>
                        <form class="d-flex" action="actionConnexion" method="POST">
                            <input class="form-control me-2" type="email" name="email" placeholder="Votre email" required>
                            <input class="form-control me-2" type="password" name="password" placeholder="Votre mot de passe" required>
                            <button class="btn btn-outline-success my-2 my-sm-0 me-2" type="submit">Connexion</button>
                        </form>
                        <a href="<?php echo BASE_URL.SEPARATOR."accueil"?>" class="btn btn-outline-success my-2 my-sm-0 me-2" type="submit">Inscription</a>
                    <?php endif ?>
                    <?php if(isset($_SESSION["customer"])): ?>
                        <a href="<?php echo BASE_URL.SEPARATOR."profil"?>" class="btn btn-outline-success my-2 my-sm-0 me-2" type="submit">Profil</a>
                        <a href="<?php echo BASE_URL.SEPARATOR."deconnexion"?>" class="btn btn-outline-success my-2 my-sm-0 me-2" type="submit">Deconnexion</a>
                    <?php endif ?>
                </div>
        </div>
    </nav>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>