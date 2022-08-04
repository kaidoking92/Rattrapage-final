<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Core\Context;
use App\Core\ConcreteStrategyNew;
use App\Model\Template as TemplateModel;
use App\Model\Log;
use App\Security\TemplateSecurity;
use App\Security\RoleSecurity;


class TemplateController {

    public function registerTemplate()
    {
        $template = new TemplateModel();

        $view = new View("TemplateFront/register","front");

        $view->assign("template", $template);

        if( !empty($_POST)){
            $result = Verificator::checkForm($template->getRegisterForm(), $_POST, $_FILES);
            if (empty($result)){

                $template->setName($_POST["name"]) ;
                $template->setColor(str_replace("#", "", $_POST["color"]));
                $template->setFont($_POST["font"]);
                $template->setBackground(str_replace("#", "", $_POST["background"]));
                $template->setActive(false);

                $template->save();

                header('Location: /templates');

                $context = new Context(new ConcreteStrategyNew());
                $context->executeStrategy('template', $_SESSION['email'], $template->getName());
            }
        }
    }

    public function templates()
    {
        $template = new TemplateModel();
        
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = intval(strip_tags(htmlspecialchars($_GET['page'])));
            
            if($currentPage == 0){
                $currentPage = 1;
            }
        }else{
            $currentPage = 1;
        }

        $quantity = intval($template->getAmountRows()['quantity']);
        $interval = 5;
        $templates = $template->getAllLimit(($currentPage * $interval) - $interval, $interval);

        $view = new View("TemplateFront/list",'back');
        $view->assign("templates", $templates);
        $view->assign("currentPage", $currentPage);
        $view->assign("pages", ceil($quantity/$interval));
        
    }

    public function removeTemplate()
    {
        echo "Page effacer Template<br>";
        $template = new TemplateModel();
        if(!empty($_POST)){
            $result = Verificator::checkForm($template->getRemoveTemplateForm(), $_POST);
            if(empty($result)){
                if(is_numeric($_POST['template_id'])){
                    if($_SESSION["role"]){
                        $userRole = $_SESSION["role"]; //On récupère le nom du role de l'utilisateur connecté
                        $templateSecurity = new TemplateSecurity();
                        $template = $templateSecurity->findById($_POST['template_id']);

                        if($template->getId() == 1){
                            echo "Impossible de supprimer la catégorie par défaut !";
                            header('Location: /templates?fail');
                        }else if($userRole == 'admin'){ //Si l'utilisateur connecté est un admin, alors on accepte la suppression
                            if($template->delete($_POST['template_id'])){
                                header('Location: /templates?success');
                            }else{
                                echo "erreur lors de la suppression";
                                header('Location: /templates?fail');
                            }
                        }else{
                            echo "Vous n'avez pas les droits nécessaires.";
                            header('Location: /templates?fail');
                        }
                    }                   
                }

            }
        }
    }        

    
    public function showTemplate(){
        $id = explode("/", $_SERVER["REQUEST_URI"])[2];
        $templateSecurity = new TemplateSecurity();
        $template = $templateSecurity->findById(intval($id));

        if(!empty($_POST)){
                    
            $result = Verificator::checkForm($template->getEditTemplateForm(), $_POST);
            if(empty($result)){

                $template->setName($_POST["name"]) ;
                $template->setColor(str_replace("#", "", $_POST["color"]));
                $template->setFont($_POST["font"]);
                $template->setBackground(str_replace("#", "", $_POST["background"]));
            
                $template->save();
                header('Location: /templates');
            }
        }

            
        $view = new View("TemplateFront/edit",'front');
        $view->assign("template", $template);        
      
    }

    public function updateTemplate(){
        $id = explode("/", $_SERVER["REQUEST_URI"])[2];
        $templateSecurity = new TemplateSecurity();
        $template = $templateSecurity->findById(intval($id));
        $template->activeTemplate();
        
        header('Location: /templates');
    }

}