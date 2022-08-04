<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;
use App\Model\Category as CategoryModel;
use App\Security\CategorySecurity;

class Product extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $picture = null;
    protected $description = null;
    protected $price = null;
    protected $stock = null;
    protected $id_category = null;

    public function __construct()
    {

        parent::__construct();
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = ucwords(strtolower(trim($name)));
    }

    /**
     * @return null|string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = trim($picture);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = trim($description);
    }

    /**
     * @return int
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = trim($price);
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = trim($stock);
    }

     /**
     * @return int
     */
    public function getIdCategory(): int
    {
        return $this->id_category;
    }

    /**
     * @param int $id_category
     */
    public function setIdCategory(int $id_category): void
    {
        $this->id_category = $id_category;
    }


    public function getRegisterForm(): array
    {
        $categories = new CategoryModel;
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Créer le produit"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du produit...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                ],
                "picture"=>[
                    "type"=>"file",
                    "placeholder"=>"Image du produit",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pictureForm",
                    "error"=>"Image incorrecte.",
                    ],
                "description"=>[
                    "type"=>"textarea",
                    "placeholder"=>"Description du produit...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"descriptionForm",
                    "max"=>500,
                    "error"=>"Description incorrect.",
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"Prix du produit...",
                    "class"=>"inputForm",
                    "id"=>"priceForm",
                    "min"=>0,
                    "step"=>0.5,
                    "error"=>"Prix incorrect."
                ],
                "stock"=>[
                    "type"=>"number",
                    "placeholder"=>"Stock du produit...",
                    "class"=>"inputForm",
                    "id"=>"stockForm",
                    "min"=>0,
                    "step"=>1,
                    "error"=>"Stock incorrect."
                ],
                "category"=>[
                    "type"=>"select",
                    "class"=>"inputForm",
                    "id"=>"categoryForm",
                    "label"=>"Catégorie",
                    "error"=>"Catégorie incorrecte.",
                    "optionlist"=>$categories->getCategoriesInArray(),
                ]
            ]
        ];
    } 


    public function getEditProductForm(): array
    {
        $categories = new CategoryModel;

        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour le produit"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du produit...",
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                    "value" => $this->getName()
                ],
                "picture"=>[
                    "type"=>"file",
                    "placeholder"=>"Image du produit",
                    "class"=>"inputForm",
                    "id"=>"pictureForm",
                    "error"=>"Image incorrecte",
                ],
                "description"=>[
                    "type"=>"textarea",
                    "placeholder"=>"Description du produit...",
                    "class"=>"inputForm",
                    "id"=>"descriptionForm",
                    "max"=>500,
                    "error"=>"Description incorrect.",
                    "value"=>$this->getDescription()
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"Prix du produit...",
                    "class"=>"inputForm",
                    "id"=>"priceForm",
                    "min"=>0,
                    "step"=>0.5,
                    "error"=>"Prix incorrect.",
                    "value"=>$this->getPrice()
                ],
                "stock"=>[
                    "type"=>"number",
                    "placeholder"=>"Quantité en stock...",
                    "class"=>"inputForm",
                    "id"=>"stockForm",
                    "min"=>0,
                    "step"=>1,
                    "error"=>"Quantité incorrecte.",
                    "value"=>$this->getStock()
                ],
                "category"=>[
                    "type"=>"select",
                    "class"=>"inputForm",
                    "id"=>"categoryForm",
                    "label"=>"Catégorie",
                    "error"=>"Catégorie incorrecte.",
                    "optionlist"=>$categories->getCategoriesInArray(),
                    "optionSelected"=>$this->getIdCategory()
                ]
            ],
            'images'=>[
                "oldPicture"=>[
                    "type"=>"img",
                    "from"=>"public/img/product/",
                    "input"=>"picture",
                    "class"=>"inputForm",
                    "id"=>"oldPictureForm",
                    "value" => $this->getPicture()
                ],
            ]
        ];
    }
    //
    public function getRemoveProductForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"product-remove",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "product_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function getAddProductToCart(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"/addToCart",
                "submit"=>"Ajouter au panier"
            ],
            'inputs'=>[
                "product_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function setProduct($actual_product=''){

        $this->setName($_POST["name"]) ;
        $this->setDescription($_POST["description"]) ;

        if( $_POST["price"] < 1 ) {
            $_POST["price"] = 1;
        }

        $this->setPrice($_POST["price"]);

        

        if( isset($_POST["stock"]) ) {

            if( $_POST["stock"] < 0 ) {
                $_POST["stock"] = 0;
            }

            $this->setStock($_POST["stock"]);

        } else {

            $this->setStock(0);

        }

        if(isset($_POST["category"])){
            $categorySecurity = new CategorySecurity;
            $category = $categorySecurity->findById($_POST["category"]);

            if($category){
                $this->setIdCategory($_POST["category"]);
            }

        }else{
            $this->setIdCategory(1);
        } 

        if(isset($_FILES["picture"]) && $_FILES["picture"]['error'] != 4){
            if(is_uploaded_file($_FILES["picture"]["tmp_name"])){
                $fileName = uniqid("product_", true) . "_" . $_FILES["picture"]["name"];
                $tmp_name = "public/img/product/" . $fileName;
                
                if (!file_exists('public/img/product')) {
                    mkdir('public/img/product', 0777, true);
                }
                
                move_uploaded_file($_FILES["picture"]["tmp_name"], $tmp_name);

                if (!empty($actual_product)) {
                    if(file_exists("public/img/product/" . $actual_product->getPicture())){
                        unlink("public/img/product/" . $actual_product->getPicture());
                    }
                }

                $this->setPicture($fileName);
            }
        }
        return true;

    }

    public function getAllProducts()
    {
        $products = $this->getAll(['id','name','picture','description','price','stock']);

        return $products;
    }

    public function findById(int $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }

    public function findAllByCategory(int $id)
    {
       $result = $this->getAllWhere(null, ["id_category",$id]);
      
      return $result;
    }
 

}
