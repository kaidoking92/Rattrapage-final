<?php

namespace App\Security;

use App\Core\Sql;
use App\Model\Template;

class TemplateSecurity extends Sql
{

    public function __construct()
    {
        parent::__construct('template', Template::class);
    }


    public function findById(int $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }
}