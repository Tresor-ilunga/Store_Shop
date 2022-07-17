<?php

class DataLayer
{
    /**
     * Connection à la base des données
     * @var
     */
    private $connexion;

    public function __construct()
    {
        try
        {
            $this->connexion = new PDO("mysql:host=".HOST.";dbname=".DB_NAME,DB_USER, DB_PASSWORD);
            //echo 'connexion success';
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Fonction qui permet de créer un customers en base de donnés
     * @param pseudo le pseudo du customer
     * @param email l'email du customer
     * @param password le mot de passe dy customer
     * @return TRUE si en cas de création avec succès du customer, FALSE si non
     * @return NULL s'il y a une exception déclenchée
     */
    public function createCustomers($pseudo, $email, $password)
    {
        $sql = "INSERT INTO customers (pseudo, email, password) VALUES (:pseudo,:email,:password)";

        try 
        {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':password' => sha1($password)
            ));
            if($var)
            {
                return true;
            }
            else
            {
                return false;
            }
        } 
        catch (PDOException $e) 
        {
            return null;
        }
    }


    /**
     * Fonction qui permet d'authentifier un customers
     *
     * @param email l'email du customer
     * @param password le password du customer
     * @return array tableau contenant les infos du customer si 'l'authentification à réussie
     * @return false si l'uathentification à échouée
     * @return null s'il y a une exception declenchée
     */
    public function authentifier($email, $password)
    {
        $sql = "SELECT * FROM customers WHERE email = :email";

        try
        {
            $result = $this->connexion->prepare($sql);
            $result->execute(array(':email'=>$email));
            $data = $result->fetch(PDO::FETCH_ASSOC);
            if($data && ($data['password'] == sha1($password))){
                unset($data['password']);
                return $data;
            }
            else{
            return false;
            }
        }
        catch (PDOException $e) 
        {
            return null;
        }
    }

    /**
     * Fonction qui permet de créer un customers en base des données
     *
     * @param idCustomers l'identifiant du customers
     * @param idProduct l'identifiant du produit de la commande
     * @param quantity la quantité du produit commander
     * @param price le prix de la commande
     * @return true si en cas de commande réaliser avec succès, FALSE si non
     * @return null s'il y a une exception declenchée
     */
    public function createOrders($idCustomers, $idProduct, $quantity, $price)
    {
        $sql = "INSERT INTO `orders`(`id_customers`, `id_product`, `quantity`, `price`) 
        VALUES (:id_customers, :id_product, :quantity, :price)";

        try
        {

            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
            ':id_customers' => $idCustomers,
            ':id_product'   => $idProduct,
            ':quantity'     => $quantity,
            ':price'        => $price
            ));
            if($var){
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $e) 
        {
            return null;
        }
    }

    /**
     * Fonction qui permet de mettre a jour les informations d'un utilisateur en base des données
     * @param newInfos Tableau associatif 
     * @return true si en cas de succès de la mise à jour reussie, FALSE si non
     * @return null s'il y a une exception déclenchée
     */
    public function updateInfosCustomers($newInfos){

        $sql = "UPDATE `customers` SET";

        try 
        {
            foreach($newInfos as $key => $value){
                $sql .= " $key = '$value' ,";
            }
            $sql = substr($sql,0,-1);
            $sql .= " WHERE id = :id";
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array('id'=>$newInfos['id']));
            if($var){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) 
        {
            return null;
        }
    }

    /**
     * Fonction qui sert à récupérer les catégories des produits
     *
     * @return array tableau contenant les catégories
     * @return null s'il y a une exception déclenchée
     */
    public function getCategory(){
        $sql = "SELECT * FROM category";

        try
        {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if($data){
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e)
        {
            return null;
        }
    }

    /**
     * Fonction qui sert à récuperer les produits au sein de la base des données
     *
     * @param limit paramètre optionnel, permet de definir les nombres à récuperer
     * @return array tableau contenant les produits, en cas de success FALSE si non
     * @return null s'il y a une exception déclenchée
     */
    public function getProduct($limit = null, $catgeory = null){
        $sql = "SELECT * FROM product ";
        $sql = "SELECT * FROM product ";
        try
        {
            if(!is_null($catgeory)){
                $sql .= ' WHERE category = '.$catgeory;
            }
            if(!is_null($limit)){
                $sql.= ' LIMIT '.$limit;
            }
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if($data){
                return $data;
            }
            else{
                return false;
            }
        }catch(PDOException $e)
        {
            return null;
        }
    }
}