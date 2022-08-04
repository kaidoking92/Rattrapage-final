<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Core\Context;
use App\Core\ConcreteStrategyNew;
use App\Model\Product as ProductModel;
use App\Model\Checkout as CheckoutModel;
use App\Security\ProductSecurity;
use App\Security\RoleSecurity;


class ProductController {

    public function registerProduct()
    {
        $product = new ProductModel();

        $view = new View("Product/register", "back");

        $view->assign("product", $product);

        if( !empty($_POST)){
            $result = Verificator::checkForm($product->getRegisterForm(), $_POST, $_FILES);

            if (empty($result)){
                $product->setProduct();
                $product->save();
                header('Location: /products');

                $context = new Context(new ConcreteStrategyNew());
                $context->executeStrategy('product', $_SESSION['email'], $product->getName());
            } else {
            }    
        }
    }

    public function products()
    {
        
        $product = new ProductModel();
        
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = intval(strip_tags(htmlspecialchars($_GET['page'])));
            
            if($currentPage == 0){
                $currentPage = 1;
            }
        }else{
            $currentPage = 1;
        }

        $quantity = intval($product->getAmountRows()['quantity']);
        $interval = 5;
        $products = $product->getAllLimit(($currentPage * $interval) - $interval, $interval);

        $view = new View("Product/list",'back');
        $view->assign("products", $products);
        $view->assign("currentPage", $currentPage);
        $view->assign("pages", ceil($quantity/$interval));
        
    }

    public function removeProduct()
    {
        $product = new ProductModel();
        if(!empty($_POST)){
            $result = Verificator::checkForm($product->getRemoveProductForm(), $_POST);
            if(empty($result)){
                if(is_numeric($_POST['product_id'])){
                    if($_SESSION["role"]){
                        $userRole = $_SESSION["role"]; //On récupère le nom du role de l'utilisateur connecté
                        $productSecurity = new ProductSecurity();
                        $product = $productSecurity->findById($_POST['product_id']);

                        if($userRole == 'admin'){ //Si l'utilisateur connecté est un admin, alors on accepte la suppression
                            $picture = "public/img/product/" . $product->getPicture();
                            if($product->delete($_POST['product_id'])){
                                if(file_exists($picture)) {
                                    unlink($picture);
                                }
                                header('Location: /products?success');
                            }else{
                                echo "erreur lors de la suppression";
                                header('Location: /products?fail');
                            }
                        }else{
                            echo "Vous n'avez pas les droits nécessaires.";
                            header('Location: /products?fail');
                        }
                    }                   
                }

            }
        }
    }

    public function showProduct(){

        $id = explode("/", $_SERVER["REQUEST_URI"])[2];

        $productSecurity = new ProductSecurity();
        $product = $productSecurity->findById($id);

        if(!empty($_POST)){
                    
            $result = Verificator::checkForm($product->getEditProductForm(), $_POST, $_FILES);

            if(empty($result)){
                $product->setProduct($product);                
                $product->save();
                echo "<br>Produit mis à jour";
            }
        }

            
        $view = new View("product/edit",'back');
        $view->assign("product", $product);
      
    }

    public function showPageProduct(){

        $id = explode("/", $_SERVER["REQUEST_URI"])[2];

        $product = new ProductModel();

        $product = $product->findById($id);

        if($product){
            $view = new View("Product/show",'front');
            $view->assign("product", $product);
        }else{
            die('404 le produit n\'existe pas');
        }

    }

    public function AddToCart(){

        if(!isset($_SESSION['cart'])){ // On verifie qu'on a bien le panier en session, sinon on le créée
            $_SESSION['cart'] = [];
        }

        if(!empty($_POST)){
            $product = new ProductModel();  
            $result = Verificator::checkForm($product->getAddProductToCart(), $_POST, $_FILES);

            if(empty($result)){

                if(Verificator::checkIfInt($_POST['product_id'])){
                    $product = $product->findById($_POST['product_id']);
                    if($product){
                        $_SESSION['cart'][] = $_POST['product_id'];
                        echo('produit ajouté avec succès au panier');
                        header('Location: /pageProduct/'.$_POST['product_id']);
                    }else{
                        header('Location: /');
                    }
                }else{
                    header('Location: /');
                }

            }
        }else{
            header('Location: /');
        }
      
    }

    public function EmptyCart(){
        $_SESSION['cart']= [];
    }

    public function showCart(){

        if(isset($_GET['success']) && $_GET['success'] === 'true'){
            echo "Le panier a bien été acheté";
        }
        if(!isset($_SESSION['cart'])){ // On verifie qu'on a bien le panier en session, sinon on le créée
            $_SESSION['cart'] = [];
        }
        $products = [];

        $products['quantity'] = [];

        foreach( $_SESSION['cart'] as $productInCart){
            $product = new ProductModel();  

            $product = $product->findById($productInCart);
        
            if($product){
                $products[$product->getId()] = $product;

                if( array_key_exists($product->getId(), $products['quantity'])) {
                    $products['quantity'][$product->getId()] += 1;
                } else {
                    $products['quantity'][$product->getId()] = 1;
                }     

            }
        }

        $checkout = new CheckoutModel();  

        $view = new View("cart/show",'front');
        $view->assign("products", $products);
        $view->assign("checkout", $checkout);

       
      
    }

}