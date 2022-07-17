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

function displayCategory() 
{
    global $model;
    global $url;
    global $category;
    //print_r($url); exit();
    if(isset($url[1]) && is_numeric($url[1]) && $url[1]>0 && $url[1]<= sizeof($category)) // La condition qui verifie la valaur taper par l'utilisateur
    {
        $result = '<h1> Produit de la catégorie '.$category[$url[1]-1]["name"].'</h1>';
        $dataProduct = $model->getProduct(null,$url[1]);

        foreach($dataProduct as $key => $value)
        {
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
    }
    else
    {
        $result = '<h1> URL incorrect ! </h1>';
    }
    return $result;
}
