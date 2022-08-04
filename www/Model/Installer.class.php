<?php
namespace App\Model;


class Installer 
{

        public function getInstallerForm(): array
            {
                return [
                    "config"=>[
                        "method"=>"POST",
                        "action"=>"",
                        "buttonClass" =>"",
                        "submit"=>"Initialisation du projet"
                    ],
                    'inputs'=>[
                        "db_name"=>[
                            "type"=>"text",
                            "label"=>"Nom base de donnée",
                            "placeholder"=>"Nom base de donnée",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "cmsresto",
                            "error"=>"error db_user"
                        ],
                        "db_host"=>[
                            "type"=>"text",
                            "label"=>"db host",
                            "placeholder"=>"db host",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "database",
                            "error"=>"Nom d'utilisateur base de donnée"
                        ],
                        "db_port"=>[
                            "type"=>"text",
                            "label"=>"db port",
                            "placeholder"=>"db port",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "3306",
                            "error"=>"Nom d'utilisateur base de donnée"
                        ],
                        "db_driver"=>[
                            "type"=>"text",
                            "label"=>"db driver",
                            "placeholder"=>"db driver",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "mysql",
                            "error"=>"driver base de donnée"
                        ],
                        "db_user"=>[
                            "type"=>"text",
                            "label"=>"Utilisateur base de donnée",
                            "placeholder"=>"Utilisateur base de donnée",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "cmslogin",
                            "error"=>"error db_user"
                        ],
                        "db_password"=>[
                            "type"=>"password",
                            "label"=>"Password base de donnée",
                            "placeholder"=>"Password base de donnée",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "password",
                            "error"=>"error db_password"
                        ],
                        "db_prefix"=>[
                            "type"=>"text",
                            "label"=>"Prefix des tables",
                            "placeholder"=>"Prefix des tables",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "resto_",
                            "error"=>"error db_user"
                        ],
                        "sitename"=>[
                            "type"=>"text",
                            "label"=>"Nom du site",
                            "placeholder"=>"Nom du site",
                            "class"=>"inputForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "cms-restaurant",
                            "error"=>"error db_user"
                        ],
                        "email"=>[
                            "type"=>"email",
                            "label"=>"Votre email",
                            "placeholder"=>"Votre email ...",
                            "required"=>true,
                            "class"=>"inputForm",
                            "id"=>"emailForm",
                            "error"=>"Email incorrect",
                            "unicity"=>"true",
                            "value"=> "test@test.fr",
                            "errorUnicity"=>"Email déjà en bdd",
                        ],
                        "password"=>[
                            "type"=>"password",
                            "label"=>"Votre mot de passe",
                            "placeholder"=>"Votre mot de passe ...",
                            "required"=>true,
                            "class"=>"inputForm",
                            "id"=>"pwdForm",
                            "value"=> "test",
                            "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                            ],
                        "passwordConfirm"=>[
                            "type"=>"password",
                            "label"=>"Confirmation",
                            "placeholder"=>"Confirmation ...",
                            "required"=>true,
                            "class"=>"inputForm",
                            "id"=>"pwdConfirmForm",
                            "value"=> "test",
                            "confirm"=>"password",
                            "error"=>"Votre mot de passe de confirmation ne correspond pas",
                        ],
                        "firstname"=>[
                            "type"=>"text",
                            "label"=>"Votre prénom",
                            "placeholder"=>"Votre prénom ...",
                            "class"=>"inputForm",
                            "id"=>"firstnameForm",
                            "min"=>2,
                            "max"=>50,
                            "value"=> "firstname",
                            "error"=>"Prénom incorrect"
                        ],
                        "lastname"=>[
                            "type"=>"text",
                            "label"=>"Votre nom",
                            "placeholder"=>"Votre nom ...",
                            "class"=>"inputForm",
                            "id"=>"lastnameForm",
                            "min"=>2,
                            "max"=>100,
                            "value"=> "lastname",
                            "error"=>"Nom incorrect"
                        ],
                        "hostmail"=>[
                            "type"=>"text",
                            "label"=>"Hostmail",
                            "placeholder"=>"Hostmail",
                            "class"=>"inputForm",
                            "id"=>"lastnameForm",
                            "min"=>2,
                            "max"=>100,
                            "value"=> "smtp.gmail.com",
                            "error"=>"Nom incorrect"
                        ],
                        "mailusername"=>[
                            "type"=>"text",
                            "label"=>"Mail username",
                            "placeholder"=>"Mail username",
                            "class"=>"inputForm",
                            "id"=>"lastnameForm",
                            "min"=>2,
                            "max"=>100,
                            "value"=> "a.bouzalmad.cms@gmail.com",
                            "error"=>"Nom incorrect"
                        ],
                        "mailpassword"=>[
                            "type"=>"password",
                            "label"=>"Mail password",
                            "placeholder"=>"Mail password",
                            "class"=>"inputForm",
                            "id"=>"lastnameForm",
                            "min"=>2,
                            "max"=>100,
                            "value"=> "froeeqjwdqufwfpy",
                            "error"=>"Nom incorrect"
                        ],
                        "setmail"=>[
                            "type"=>"text",
                            "label"=>"Adresse mail site",
                            "placeholder"=>"Adresse mail site",
                            "class"=>"inputForm",
                            "id"=>"lastnameForm",
                            "min"=>2,
                            "max"=>100,
                            "value"=> "a.bouzalmad.cms@gmail.com",
                            "error"=>"Nom incorrect"
                        ]
                    ]
                ];
            }
}