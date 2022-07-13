<?php

function displayAccueil()
{
    return "<h1>Bienvenu sur la page d'accueil</h1>";
}

function displayContact()
{
    return "<h1>Bienvenu sur la page de contact</h1>";
}

function displayProduit()
{
    global $model;
    $dataProduct = $model->getProduct();
    
    $result = "<h1>Bienvenu sur la page Produits</h1>";
    foreach ($dataProduct as $key => $value) {
        $result .= '
        <div class="card" style="width: 18rem; display:inline-block">
            <img src="'.BASE_URL.SEPARATOR."images".SEPARATOR."produit".SEPARATOR.$value["image"].'" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">'.$value['name'].'</h5>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary">Détails</a>
                <a href="#" class="btn btn-success">Acheter</a>
            </div>
        </div>';
    }


    return $result;
}
