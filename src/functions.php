<?php

function displayAccueil()
{
    $result = '<h1>Bienvenu sur la page d\'accueil</h1>';
    $result .= '<div class="bg-white shadow-sm rounded p-6">
    <form action="actionInscription" method="POST">
        <div class="mb-4">
            <h2 class="h4">INSCRIPTION</h2>
        <div>

        <!-- Input -->
        <div class="mb-3">
            <div class="input-group input-group form">  
                <input type="text" name="pseudo" value="Admin1" class="form-control" required>
            </div>
        </div>
        <!-- End Input --> 

        <!-- Input -->
        <div class="mb-3">
            <div class="input-group input-group form">
                <input type="email" name="email" value="admin1@admin.com" class="form-control" required>
            </div>
        </div>
        <!-- End Input --> 

        <!-- Input -->
        <div class="mb-3">
            <div class="input-group input-group form">
                <input type="password" name="password" value="Admin1" class="form-control" required>
            </div>
        </div>
        <!-- End Input --> 
        <button type="submit" class="btn btn-block btn-primary">Inscription</button>
    </form>
    </div>';
    return $result;
}

function displayActionInscription(){
    global $model;
    //print_r($_REQUEST); exit();
    $pseudo = $_REQUEST["pseudo"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    $data = $model->createCustomers($pseudo,$email,$password);
    if($data){//Inscription reussie
        $data_customer = $model->authentifier($email,$password);
        if($data_customer){
            $_SESSION["customer"] = $data_customer;
            return '<p class="btn btn-block btn-success">Inscription réussie '.$pseudo.', vous êtes bien connecter !<p>'.displayProduit();
        }
    }else{// Inscription échouée
        return '<p class="btn btn-block btn-danger">Desolé, votre inscription à échouée !<p>'.displayProduit();
    }
}

function displayDeconnexion(){
    unset($_SESSION["customer"]);
    return '<p class="btn btn-block btn-success">Déconnexion réussie, vous êtes bien deconnecter !<p>'.displayProduit();
}

function displayActionConnexion(){
    global $model;
    //print_r($_REQUEST); exit();
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $data_customer = $model->authentifier($email,$password);
    if($data_customer){
        $_SESSION["customer"] = $data_customer;
        return '<p class="btn btn-block btn-success">Authentification réussie , vous êtes bien authentifier !<p>'.displayProduit();
    }
    else{// Inscription échouée
        return '<p class="btn btn-block btn-danger">Desolé, votre authentification à échouée !<p>'.displayProduit();
    }
}

function displayContact()
{
    $result = '<h1>Bienvenu sur la page de contact</h1>';
    $result .= '
    <h1 class="text-center">Contactez-nous !</h1>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    ';




    return $result;
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
                <a href="'.BASE_URL.SEPARATOR."details".SEPARATOR.$value['id'].'" class="btn btn-primary">Détails</a>
                <a href="'.BASE_URL.SEPARATOR."panier".SEPARATOR.$value['id'].'" class="btn btn-success">Acheter</a>
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
                    <a href="'.BASE_URL.SEPARATOR."details".SEPARATOR.$value['id'].'" class="btn btn-primary">Détails</a>
                    <a href="'.BASE_URL.SEPARATOR."panier".SEPARATOR.$value['id'].'" class="btn btn-success">Acheter</a>
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


function displayDetails(){
    global $model;
    global $url;
    global $category;
    $result = '<h1>Bienvenu sur la page de détails produits</h1>';
    $dataProduct = $model->getProduct(null,null,$url[1]);
    //print_r($dataProduct); exit();

    $result .= '
    <div class="row details">
        <div class="col-md-5 col-12">
            <img src="'.BASE_URL.SEPARATOR."images".SEPARATOR."produit".SEPARATOR.$dataProduct[0]["image"].'" class="card-img-top" alt="img_details">
        </div>
        <div class="col-md-7 col-12">
            <h2>'.$dataProduct[0]["name"].'</h2>
            <p>'.$dataProduct[0]["description"].'</p>
            <p>Catégorie : '.$category[$dataProduct[0]["category"]-1]["name"].'</p>
            <a href="'.BASE_URL.SEPARATOR."panier".SEPARATOR.$dataProduct[0]['id'].'" class="btn btn-block btn-success">Ajouter au panier</a>
            <a href="'.BASE_URL.SEPARATOR."produit".'" class="btn btn-block btn-primary">Retour</a>
        </div>
    </div>';
    return $result;
}


function displayPanier(){
    global $model;
    global $url;
    if(isset($url[1])){
        $idProduit = $url[1];
        $dataProduct = $model->getProduct(null, null,$url[1]);
        $_SESSION['panier'][] = $dataProduct[0];
    }
    
    if(!isset($_SESSION['panier']) || sizeof($_SESSION["panier"]) == 0){
        return '<h1>Votre panier est vide !</h1>'.displayProduit();
    }
    $result ='<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Images</th>
            <th scope="col">Prix</th>
            <th scope="col">Quantité</th>
            <th scope="col">Action</th>
        </tr>    
    </thead>
    <tbody>';

    $total_price = 0;

    foreach($_SESSION['panier'] as $key => $value){
        $total_price += $value["price"];
        $result .= '<tr>
        <th scope="row">'.$value["id"].'</th>
        <td>'.$value["name"].'</td>
        <td>'.$value["description"].'</td>
        <td><img src="'.BASE_URL.SEPARATOR."images".SEPARATOR."produit".SEPARATOR.$value["image"].'" alt="img"></td>
        <td>'.$value["price"].'$</td>
        <td>1</td>
        <td><a href="'.BASE_URL.SEPARATOR."supprimer".SEPARATOR.$key.'" class="btn btn-block btn-danger">Supprimer</a></td>
        </tr>';
    }
    $total_tva = $total_price*TVA/100;
    $total_ttc = $total_tva + $total_price;
    $result .= '<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Prix total (HT)</td>
    <td>'.number_format($total_price, 2).'$</td>
    </tr>
    
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>TVA ('.TVA.'%)</td>
    <td>'.number_format($total_tva, 2).'$</td>
    </tr>
    
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Total (TTC)</td>
    <td>'.number_format($total_ttc, 2).'$</td>
    </tr>';


    $result .= '</tbody>
                </table>';
    return $result;            
}


function displaySupprimer(){
    global $url;
    //print_r($_SESSION ["panier"]); exit();
    if(isset($url[1]) && is_numeric($url[1])){
        $param = $url[1];
        unset($_SESSION["panier"][$param]);
        header("Location: ".BASE_URL.SEPARATOR."panier");
    }
}