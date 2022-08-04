<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class Template extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $color = null;
    // protected $logo = null;
    protected $background = null;
    protected $font = null;

    public function activeTemplate()
    {  
        $this->desactivateAll();
        $this->updateTemplate('active', 1);
    }

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
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(?string $color): void
    {
        $this->color = trim($color);
    }

    /**
     * @return null|string
     */
    public function getFont(): ?string
    {
        return $this->font;
    }

    /**
     * @param string $font
     */
    public function setFont(?string $font): void
    {
        $this->font = trim($font);
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): void
    {
        $this->background = trim($background);
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }


    // public function getlogo(): ?string
    // {
    //     return $this->logo;
    // }

    // public function setlogo(?string $logo): void
    // {
    //     $this->logo = trim($logo);
    // }

    


    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Créer la template"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Nom du template",
                    "placeholder"=>"Nom du template...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                ],
                "color"=>[
                    "type"=>"color",
                    "label"=>"Couleur du template",
                    "placeholder"=>"Couleur du template",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"colorForm",
                    "error"=>"La couleur doit être une valeur hexadécimale (3 ou 6 caractères, préfixés ou non du \"#\".",
                ],
                "font"=>[
                    "type"=>"string",
                    "label"=>"Lien de la Police de caractères",
                    "placeholder"=>"Police de caractères",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"fontForm",
                    "error"=>"Le lien de la police de caracteres est incorrect",
                ],
                "background"=>[
                    "type"=>"color",
                    "label"=>"Couleur du fond",
                    "placeholder"=>"Couleur du fond",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"backgroundForm",
                    "error"=>"Couleur du fond est incorrect",
                ],
                // "active"=>[
                //     "type"=>"checkbox",
                //     "label"=>"Activer le template",
                //     "placeholder"=>"Activer le template",
                //     "required"=>false,
                //     "class"=>"inputForm",
                //     "value"=>true,
                //     "id"=>"activeForm",
                //     "error"=>"Ce champ est obligatoire",
                // ], 
                // "logo"=>[
                //     "type"=>"file",
                //     "label"=>"Logo du template",
                //     "placeholder"=>"Logo du template",
                //     "required"=>true,
                //     "class"=>"inputForm",
                //     "id"=>"logoForm",
                //     "error"=>"Logo incorrecte.",
                //     ],
                
            ]
        ];
    }


    public function getEditTemplateForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Modifier la template"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Nom du template",
                    "placeholder"=>"Nom du template...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                    "value"=>$this->getName()
                ],
                "color"=>[
                    "type"=>"color",
                    "label"=>"Couleur du template",
                    "placeholder"=>"Couleur du catégorie",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"colorForm",
                    "error"=>"La couleur doit être une valeur hexadécimale (3 ou 6 caractères, préfixés ou non du \"#\".",
                    "value"=>$this->getColor()
                ],
                "font"=>[
                    "type"=>"string",
                    "label"=>"Lien de la Police de caractères",
                    "placeholder"=>"Police de caractères",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"fontForm",
                    "error"=>"Le lien de la police de caracteres est incorrect",
                    "value"=>$this->getFont()
                ],
                "background"=>[
                    "type"=>"color",
                    "label"=>"Couleur du fond",
                    "placeholder"=>"Couleur du fond",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"backgroundForm",
                    "error"=>"Le lien de l'image de fond est incorrect",
                    "value"=>$this->getBackground()
                ],
                // "active"=>[
                //     "type"=>"checkbox",
                //     "label"=>"Activer le template",
                //     "placeholder"=>"Activer le template",
                //     "required"=>false,
                //     "class"=>"inputForm",
                //     "id"=>"activeForm",
                //     "error"=>"Ce champ est obligatoire",
                //     "value"=>$this->getActive()
                // ],



                // "logo"=>[
                //     "type"=>"file",
                //     "label"=>"Logo du template",
                //     "placeholder"=>"Logo du template",
                //     "required"=>true,
                //     "class"=>"inputForm",
                //     "id"=>"logoForm",
                //     "error"=>"Logo incorrecte.",
                //     "value"=>$this->getLogo()
                // ],
            ]
        ];
    }

    public function getRemoveTemplateForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"template-remove",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "template_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function setTemplate(){

        $this->setName($_POST["name"]) ;
        $this->setColor(str_replace("#", "", $_POST["color"]));
        $this->setFont($_POST["font"]);
        $this->setBackground($_POST["background"]);
        // $this->setLogo($_POST["logo"]);

        return true;

    }


    public function getAllTemplates()
    {
        $templates= $this->getAll(['id','name','color','font','background']);

        return $templates;
    }

    public function getTemplatesInArray()
    {
        $templates = $this->getAll(['id','name']);

        $templatesList = [];
        foreach ($templates as $template) {
            $templatesList += [$template->getName()=>$template->getId()];
        }

        return $templatesList;
    }
 

}
