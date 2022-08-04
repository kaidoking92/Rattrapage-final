<?php

namespace App\Controller;
use App\Core\Auth;
use App\Core\View;
use App\Model\Product;
use App\Model\Category;

class FrontController
{

    public function showAllProduct()
    {
        
        $product = new Product();
        
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

        $view = new View('front/list');
        $view->assign("products", $products);
        $view->assign("currentPage", $currentPage);
        $view->assign("pages", ceil($quantity/$interval));
        
    }

    public function showProductsByCategory()
    {
        $id = explode("/", $_SERVER["REQUEST_URI"])[2];

        $category = new Category();
        $category = $category->findById($id);

        $product = new Product();
        $products = $product->findAllByCategory($category->getId());

        $view = new View('front/category');
        $view->assign("category", $category);
        $view->assign("products", $products);

    }

    public function showCategories()
    {
        
        $category = new Category();
        $categories = $category->getAllCategories();

        $view = new View('front/categories');
        $view->assign("categories", $categories);
        
    }

}