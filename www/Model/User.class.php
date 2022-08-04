<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;
use App\Model\Comment as CommentModel;
use App\Core\Mailsender;



class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $password;
    protected $status = 0;
    protected $id_role = 1;
    protected $token = null;
    protected $reset_token = null;
    protected $auth_token = null;
    protected $reset_token_expiration = null;
    protected $token_expiration = null;

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
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param null|string
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

     /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->id_role;
    }

    /**
     * @param int $id_role
     */
    public function setRoleId(int $id_role): void
    {
        $this->id_role = $id_role;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return null|string
     */
    public function getTokenExpiration(): ?string
    {
        return $this->token_expiration;
    }
    
     /**
     * @return null|string
     */
    public function getAuthToken(): ?string
    {
        return $this->auth_token;
    }

    /**
     * @return null|string
     */
    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    /**
     * length : 255
     */
    public function generateToken(): void
    {
        $this->token = substr(bin2hex(random_bytes(128)), 0, 255);
        $expiration_date = time()+3600;
        $this->token_expiration = date("Y-m-d H:i:s", $expiration_date);
        
    }

    /**
     * length : 255
     */
    public function generateAuthToken(): void
    {
        $this->auth_token = substr(bin2hex(random_bytes(128)), 0, 255);        
    }

    /**
     * length : 255
     */
    public function generateResetToken(): void
    {
        $this->reset_token = substr(bin2hex(random_bytes(128)), 0, 255);   
        $expiration_date = time()+3600;
        $this->reset_token_expiration = date("Y-m-d H:i:s", $expiration_date);     
    }

    public function emptyResetToken(): void
    {
        $this->reset_token = NULL;
        $this->reset_token_expiration = NULL;
    }

    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"S'inscrire"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect",
                    "unicity"=>"true",
                    "errorUnicity"=>"Email déjà en bdd",
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Prénom incorrect"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Nom incorrect"
                ],
            ]
        ];
    }

    public function getLoginForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Se connecter"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect"
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm"
                ]
            ]
        ];
    }

    public function getForgetPasswordForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Envoyer un lien pour changer mon mot de passe"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect"
                ]
            ]
        ];
    }


    public function getResetPasswordForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Changer mon mot de passe"
            ],
            'inputs'=>[
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ]
            ]
        ];
    }

    public function getChangePasswordForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Changer mon mot de passe"
            ],
            'inputs'=>[
                "currentPassword"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Nouveau mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ]
            ]
        ];
    }

    public function getProfileForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour son profil"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect",
                    "unicity"=>"true",
                    "errorUnicity"=>"Email déjà en bdd",
                    "value" => $this->getEmail()
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Prénom incorrect",
                    "value" => $this->getFirstname()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Nom incorrect",
                    "value" => $this->getLastname()
                ]
            ]
        ];
    }

    public function getEditUserForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour son profil"
            ],
            'inputs'=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "label"=>'Prenom',
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Prénom incorrect",
                    "value" => $this->getFirstname()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "label"=>"Nom",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Nom incorrect",
                    "value" => $this->getLastname()
                ],
                "role"=>[
                    "type"=>"radio",
                    "class"=>"inputForm",
                    "id"=>"roleForm",
                    "label"=>"Role",
                    "error"=>"Role incorrect",
                    "radiolist"=> ['user' => 1 ,'editor'=> 2,'admin' => 3],
                    "radioChecked"=>$this->getRoleId()
                ]
            ]
        ];
    }

    public function getRemoveUserForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"user-remove",
                "buttonClass" =>"button button--white",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "user_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function setUser(){

        $this->setFirstname($_POST["firstname"]) ;
        $this->setLastname($_POST["lastname"]) ;
        $this->setEmail($_POST["email"]) ;
        $this->setPassword($_POST["password"]) ;
        $this->setStatus(0);
        $this->setRoleId(1);
        $this->generateToken() ;
        

        if (password_verify($_POST["passwordConfirm"] , $this->password)) {
            return true;
        }
        else {
            echo "mots de passe differents";
            return false;
        }

    }

    public function findById(string $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }

    public function getAllAdmins()
    {
        $users = $this->getAllWhere(['id','email'],['role_id', 3]);
        return $users;
    }
 

    public function update(CommentModel $comment) 
    {
        $mailtest = new Mailsender();
        $mailtest->sendsimple($user->getEmail(),"Le commentaire suivant viens d'être signalé : ".$comment->getContent());

    }

}
